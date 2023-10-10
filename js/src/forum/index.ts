import app from 'flarum/forum/app';
import ErasureRequestsListState from './states/ErasureRequestsListState';
import ExportAvailableNotification from './components/ExportAvailableNotification';
import extendUserSettingsPage from './extenders/extendUserSettingsPage';
import extendHeaderSecondary from './extenders/extendHeaderSecondary';
import extendPage from './extenders/extendPage';

export { default as extend } from './extend';

app.initializers.add('blomstra-gdpr', () => {
  app.erasureRequests = new ErasureRequestsListState();

  app.notificationComponents.gdprExportAvailable = ExportAvailableNotification;

  extendUserSettingsPage();
  extendHeaderSecondary();
  extendPage();
});
