import app from 'flarum/forum/app';
import Modal from 'flarum/common/components/Modal';
import Button from 'flarum/common/components/Button';
import username from 'flarum/common/helpers/username';
import extractText from 'flarum/common/utils/extractText';
import ItemList from 'flarum/common/utils/ItemList';
import Stream from 'flarum/common/utils/Stream';

export default class ProcessErasureRequestModal extends Modal {
  oninit(vnode) {
    super.oninit(vnode);

    this.comments = Stream('');

    this.loading = {};
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
    const items = new ItemList();

    items.add(
      'text',
      <p className="helpText">{app.translator.trans('blomstra-gdpr.forum.process_erasure.text', { name: username(this.attrs.request.user()) })}</p>
    );

    items.add(
      'comments',
      <div className="Form-group">
        <textarea
          className="FormControl"
          value={this.comments()}
          oninput={(e) => this.comments(e.target.value)}
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
              type: 'submit',
              loading: this.loading.anonymization,
              onclick: (e) => this.onsubmit(e, 'anonymization'),
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
              type: 'submit',
              loading: this.loading.deletion,
              onclick: (e) => this.onsubmit(e, 'deletion'),
            },
            app.translator.trans('blomstra-gdpr.forum.process_erasure.deletion_button')
          )}
        </div>
      );
    }

    return items;
  }

  onsubmit(e, mode) {
    e.preventDefault();

    if (
      !confirm(
        app.translator.trans('blomstra-gdpr.forum.process_erasure.confirm', {
          name: extractText(username(this.attrs.request.user())),
          mode: extractText(mode),
        })
      )
    ) {
      return;
    }

    this.loading[MediaSource] = true;
    m.redraw();

    this.attrs.request
      .save({ processor_comment: this.comments() }, { meta: { mode } })
      .then((erasureRequest) => {
        app.store.remove(erasureRequest);
        this.loading[MediaSource] = false;
        m.redraw();
        this.hide();
      })
      .catch(() => {
        this.loading[MediaSource] = false;
        m.redraw();
      });
  }
}
