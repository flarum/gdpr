import app from 'flarum/forum/app';
import Modal, { IInternalModalAttrs } from 'flarum/common/components/Modal';
import User from 'flarum/common/models/User';
import type Mithril from 'mithril';
import username from 'flarum/common/helpers/username';
import Button from 'flarum/common/components/Button';

interface DeleteUserModalAttrs extends IInternalModalAttrs {
  user: User;
}

export default class DeleteUserModal extends Modal<DeleteUserModalAttrs> {
  user!: User;

  oninit(vnode: Mithril.Vnode<DeleteUserModalAttrs>) {
    super.oninit(vnode);

    this.user = this.attrs.user;
  }

  className() {
    return 'DeleteUserModal Modal--small';
  }

  title() {
    return app.translator.trans('blomstra-gdpr.forum.delete_user.title', {
      username: username(this.user),
    });
  }

  content() {
    return (
      <div className="Modal-body">
        <div className="Form Form--centered">
          <p className="helpText">
            {app.translator.trans('blomstra-gdpr.forum.delete_user.text', {
              username: username(this.user),
            })}
          </p>
          <div className="Form-group">
            <Button
              className="Button Button--primary Button--block"
              onclick={() => this.requestErasure()}
              loading={this.loading}
              disabled={this.loading}
            >
              {app.translator.trans('blomstra-gdpr.forum.delete_user.delete_button')}
            </Button>
          </div>
        </div>
      </div>
    );
  }

  requestErasure() {
    this.loading = true;

    this.user.delete().then(
      () => {
        this.hide();
        this.loading = false;
        m.redraw();
      },
      () => {}
    );
  }
}
