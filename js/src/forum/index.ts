import app from 'flarum/forum/app';
import ErasureRequestsListState from './states/ErasureRequestsListState';
import ExportAvailableNotification from './components/ExportAvailableNotification';
import extendUserSettingsPage from './extenders/extendUserSettingsPage';
import extendHeaderSecondary from './extenders/extendHeaderSecondary';
import extendPage from './extenders/extendPage';
import extendUserControls from './extenders/extendUserControls';
import addAnonymousBadges from './extenders/addAnonymousBadges';

export { default as extend } from './extend';

app.initializers.add('flarum-gdpr', () => {
  app.erasureRequests = new ErasureRequestsListState();

  app.notificationComponents.gdprExportAvailable = ExportAvailableNotification;

  extendUserSettingsPage();
  extendHeaderSecondary();
  extendPage();
  extendUserControls();
  addAnonymousBadges();
});

// Expose compat API
import gdprCompat from './compat';
import { compat } from '@flarum/core/forum';

Object.assign(compat, gdprCompat);
