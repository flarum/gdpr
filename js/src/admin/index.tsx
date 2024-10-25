import app from 'flarum/admin/app';
import extendUserListPage from './extendUserListPage';
import extendAdminNav from './extendAdminNav';

export { default as extend } from './extend';

app.initializers.add('blomstra-gdpr', () => {
  app.registry.for('blomstra-gdpr');

  extendUserListPage();
  extendAdminNav();
});
