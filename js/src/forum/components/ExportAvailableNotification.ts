import app from 'flarum/forum/app';
import Notification from 'flarum/forum/components/Notification';
import Export from '../../common/models/Export';

export default class ExportAvailableNotification extends Notification {
  icon() {
    return 'fas fa-file-export';
  }

  href() {
    const exportModel = this.attrs.notification.subject() as Export;

    // Building the full url scheme so that Mithril treats this as an external link, so the download will work correctly.
    return app.forum.attribute('baseUrl') + app.route('gdpr.export', { file: exportModel.file() });
  }

  content() {
    return app.translator.trans('blomstra-gdpr.forum.notification.export-ready');
  }

  excerpt() {
    return null;
  }
}
