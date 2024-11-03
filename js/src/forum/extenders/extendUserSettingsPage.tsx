import app from 'flarum/forum/app';
import { extend } from 'flarum/common/extend';
import ItemList from 'flarum/common/utils/ItemList';
import SettingsPage from 'flarum/forum/components/SettingsPage';
import FieldSet from 'flarum/common/components/FieldSet';
import type Mithril from 'mithril';
import Button from 'flarum/common/components/Button';
import RequestErasureModal from '../components/RequestErasureModal';
import RequestDataExportModal from '../../common/components/RequestDataExportModal';

export default function extendUserSettingsPage() {
  extend(SettingsPage.prototype, 'settingsItems', function (items: ItemList<Mithril.Children>) {
    const user = this.user;

    if (!user) {
      return;
    }

    items.add(
      'dataItems',
      <FieldSet className="Settings-gdpr" label={app.translator.trans('flarum-gdpr.forum.settings.data.heading')}>
        {this.dataItems().toArray()}
      </FieldSet>,
      -100
    );
  });

  SettingsPage.prototype.dataItems = function (): ItemList<Mithril.Children> {
    const items = new ItemList<Mithril.Children>();

    items.add(
      'gdprErasure',
      <div className="gdprErasure-container">
        <Button className="Button Button-gdprErasure" icon="fas fa-user-minus" onclick={() => app.modal.show(RequestErasureModal)}>
          {app.translator.trans('flarum-gdpr.forum.settings.request_erasure_button')}
        </Button>
        <p className="helpText">{app.translator.trans('flarum-gdpr.forum.settings.request_erasure_help')}</p>
      </div>,
      50
    );

    items.add(
      'gdprExport',
      <div className="gdprExport-container">
        <Button
          className="Button Button-gdprExport"
          icon="fas fa-file-export"
          onclick={() => app.modal.show(RequestDataExportModal, { user: this.user })}
        >
          {app.translator.trans('flarum-gdpr.forum.settings.export_data_button')}
        </Button>
        <p className="helpText">{app.translator.trans('flarum-gdpr.forum.settings.export_data_help')}</p>
      </div>,
      40
    );

    return items;
  };
}
