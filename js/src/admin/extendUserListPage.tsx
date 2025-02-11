import app from 'flarum/admin/app';
import { extend } from 'flarum/common/extend';
import UserListPage from 'flarum/admin/components/UserListPage';
import Button from 'flarum/common/components/Button';
import username from 'flarum/common/helpers/username';
import RequestDataExportModal from '../common/components/RequestDataExportModal';

import type User from 'flarum/common/models/User';
import type ItemList from 'flarum/common/utils/ItemList';
import type Mithril from 'mithril';

export default function extendUserListPage() {
  extend(UserListPage.prototype, 'userActionItems', function (items: ItemList<Mithril.Children>, user: User) {
    if (!user.canModerateExports()) return;
    items.add(
      'export-data',
      <Button icon="fas fa-file-export" onclick={() => app.modal.show(RequestDataExportModal, { user: user })}>
        {app.translator.trans('flarum-gdpr.admin.userlist.columns.gdpr_actions.export', { username: username(user) })}
      </Button>
    );
  });
}
