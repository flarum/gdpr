import app from 'flarum/forum/app';
import Modal, { IInternalModalAttrs } from 'flarum/common/components/Modal';
import Button from 'flarum/common/components/Button';
import username from 'flarum/common/helpers/username';
import extractText from 'flarum/common/utils/extractText';
import ItemList from 'flarum/common/utils/ItemList';
import Stream from 'flarum/common/utils/Stream';
import type Mithril from 'mithril';
import ErasureRequest from 'src/common/models/ErasureRequest';
import User from 'flarum/common/models/User';

interface ProcessErasureRequestModalAttrs extends IInternalModalAttrs {
  request: ErasureRequest | undefined;
  user: User | undefined;
}

export default class ProcessErasureRequestModal extends Modal<ProcessErasureRequestModalAttrs> {
  comments: Stream<string>;
  loadingAnonymization: boolean = false;
  loadingDeletion: boolean = false;
  request!: ErasureRequest;

  oninit(vnode: Mithril.Vnode<ProcessErasureRequestModalAttrs>) {
    super.oninit(vnode);

    this.request =
      this.attrs.request || app.store.createRecord<ErasureRequest>('user-erasure-requests', { relationships: { user: this.attrs.user?.id() } });

    this.comments = Stream('');
  }

  className() {
    return 'ProcessErasureRequestModal Modal--small';
  }

  title() {
    return app.translator.trans('blomstra-gdpr.forum.process_erasure.title');
  }

  content() {
    return (
      <div className="Modal-body">
        <div className="Form Form--centered">{this.fields().toArray()}</div>
      </div>
    );
  }

  fields() {
    const items = new ItemList<Mithril.Children>();

    const erasureRequest = this.attrs.request;

    items.add(
      'text',
      <p className="helpText">{app.translator.trans('blomstra-gdpr.forum.process_erasure.text', { name: username(this.request.user()) })}</p>
    );

    erasureRequest?.reason() &&
      items.add(
        'reason',
        <p className="helpText">
          <code>{erasureRequest.reason()}</code>
        </p>
      );

    items.add(
      'comments',
      <div className="Form-group">
        <textarea
          className="FormControl"
          value={this.comments()}
          bidi={this.comments}
          placeholder={extractText(app.translator.trans('blomstra-gdpr.forum.process_erasure.comments_label'))}
        ></textarea>
      </div>
    );

    if (app.forum.attribute('erasureAnonymizationAllowed')) {
      items.add(
        'anonymize',
        <div className="Form-group">
          {Button.component(
            {
              className: 'Button Button--primary Button--block',
              loading: this.loadingAnonymization,
              onclick: () => this.process('anonymization'),
            },
            app.translator.trans('blomstra-gdpr.forum.process_erasure.anonymization_button')
          )}
        </div>
      );
    }

    if (app.forum.attribute('erasureDeletionAllowed')) {
      items.add(
        'delete',
        <div className="Form-group">
          {Button.component(
            {
              className: 'Button Button--danger Button--block',
              loading: this.loadingDeletion,
              onclick: () => this.process('deletion'),
            },
            app.translator.trans('blomstra-gdpr.forum.process_erasure.deletion_button')
          )}
        </div>
      );
    }

    return items;
  }

  process(mode: string) {
    if (
      !confirm(
        app.translator.trans('blomstra-gdpr.forum.process_erasure.confirm', {
          name: extractText(username(this.request.user())),
          mode,
        }) as string
      )
    ) {
      return;
    }

    if (mode === 'anonymization') {
      this.loadingAnonymization = true;
    } else {
      this.loadingDeletion = true;
    }

    m.redraw();

    this.request
      .save({ processor_comment: this.comments(), meta: { mode } })
      .then((erasureRequest) => {
        app.store.remove(erasureRequest);
        this.loadingAnonymization = false;
        this.loadingDeletion = false;
        m.redraw();
        this.hide();
      })
      .catch(() => {
        this.loadingAnonymization = false;
        this.loadingDeletion = false;
        m.redraw();
      });
  }
}
