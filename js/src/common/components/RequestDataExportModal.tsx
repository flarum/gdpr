import app from 'flarum/common/app';
import Modal, { IInternalModalAttrs } from 'flarum/common/components/Modal';
import Button from 'flarum/common/components/Button';
import username from 'flarum/common/helpers/username';
import User from 'flarum/common/models/User';
import type Mithril from 'mithril';
import avatar from 'flarum/common/helpers/avatar';

interface RequestDataExportModalAttrs extends IInternalModalAttrs {
  user: User;
}

export default class RequestDataExportModal extends Modal<RequestDataExportModalAttrs> {
  user!: User;

  oninit(vnode: Mithril.Vnode<RequestDataExportModalAttrs>) {
    super.oninit(vnode);

    this.user = this.attrs.user;
  }

  className() {
    return 'RequestDataModal Modal--small';
  }

  title() {
    return app.translator.trans('flarum-gdpr.lib.request_data.title', {
      username: username(this.user),
    });
  }

  content() {
    return (
      <div className="Modal-body">
        <div className="Form Form--centered">
          <div className="User">{avatar(this.user)}</div>
          <p className="helpText">{app.translator.trans('flarum-gdpr.lib.request_data.text')}</p>
          <div className="Form-group">
            <Button
              className="Button Button--primary Button--block"
              onclick={() => this.requestExport()}
              loading={this.loading}
              disabled={this.loading}
            >
              {app.translator.trans('flarum-gdpr.lib.request_data.request_button')}
            </Button>
          </div>
        </div>
      </div>
    );
  }

  requestExport() {
    this.loading = true;

    app
      .request({
        method: 'POST',
        url: app.forum.attribute('apiUrl') + '/gdpr/export',
        body: {
          data: {
            attributes: {
              userId: this.user.id(),
            },
          },
        },
      })
      .then(this.hide.bind(this), this.loaded.bind(this));
  }
}
