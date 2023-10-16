import app from 'flarum/admin/app';
import { extend } from 'flarum/common/extend';
import UserListPage from 'flarum/admin/components/UserListPage';
import ItemList from 'flarum/common/utils/ItemList';
import User from 'flarum/common/models/User';
import Tooltip from 'flarum/common/components/Tooltip';
import Button from 'flarum/common/components/Button';
import type Mithril from 'mithril';
import username from 'flarum/common/helpers/username';
import RequestDataExportModal from '../common/components/RequestDataExportModal';

type ColumnData = {
  /**
   * Column title
   */
  name: Mithril.Children;
  /**
   * Component(s) to show for this column.
   */
  content: (user: User) => Mithril.Children;
};

export default function extendUserListPage() {
  extend(UserListPage.prototype, 'columns', function (columns: ItemList<ColumnData>) {
    columns.add(
      'gdpr',
      {
        name: app.translator.trans('blomstra-gdpr.admin.userlist.columns.gdpr_actions.title'),
        content: (user: User) => {
          return <div className="gdprActions">{this.gdprActions(user).toArray()}</div>;
        },
      },
      50
    );
  });

  UserListPage.prototype.gdprActions = function (user: User): ItemList<Mithril.Children> {
    const items = new ItemList<Mithril.Children>();

    items.add(
      'export-data',
      <Tooltip text={app.translator.trans('blomstra-gdpr.admin.userlist.columns.gdpr_actions.export', { username: username(user) })}>
        <Button className="Button Button--icon" icon="fas fa-file-export" onclick={() => app.modal.show(RequestDataExportModal, { user: user })} />
      </Tooltip>
    );

    return items;
  };
}
