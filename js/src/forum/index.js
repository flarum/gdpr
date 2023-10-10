import app from 'flarum/forum/app';
import { extend } from 'flarum/common/extend';
import HeaderSecondary from 'flarum/forum/components/HeaderSecondary';
import Page from 'flarum/common/components/Page';
import ErasureRequestsDropdown from './components/ErasureRequestsDropdown';
import ErasureRequestsListState from './states/ErasureRequestsListState';
import ExportAvailableNotification from './components/ExportAvailableNotification';
import extendUserSettingsPage from './extenders/extendUserSettingsPage';

export { default as extend } from './extend';

app.initializers.add('blomstra-gdpr', () => {
  app.erasureRequests = new ErasureRequestsListState(app);

  app.notificationComponents.gdprExportAvailable = ExportAvailableNotification;

  extendUserSettingsPage();

  extend(Page.prototype, 'oninit', function () {
    if (m.route.param('erasureRequestConfirmed')) {
      app.alerts.show({ type: 'success' }, app.translator.trans('blomstra-gdpr.forum.erasure_request_confirmed'));
    }
  });

  extend(HeaderSecondary.prototype, 'items', function (items) {
    if (app.forum.attribute('erasureRequestCount')) {
      items.add('UsernameRequests', <ErasureRequestsDropdown state={app.erasureRequests} />, 20);
    }
  });
});
