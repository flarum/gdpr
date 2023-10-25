import app from 'flarum/admin/app';
import extendUserListPage from './extendUserListPage';
import extendAdminNav from './extendAdminNav';

export { default as extend } from './extend';

app.initializers.add('blomstra-gdpr', () => {
  app.extensionData
    .for('blomstra-gdpr')
    .registerSetting({
      setting: 'blomstra-gdpr.allow-anonymization',
      label: app.translator.trans('blomstra-gdpr.admin.settings.allow_anonymization'),
      help: app.translator.trans('blomstra-gdpr.admin.settings.allow_anonymization_help'),
      type: 'boolean',
    })
    .registerSetting({
      setting: 'blomstra-gdpr.allow-deletion',
      label: app.translator.trans('blomstra-gdpr.admin.settings.allow_deletion'),
      help: app.translator.trans('blomstra-gdpr.admin.settings.allow_deletion_help'),
      type: 'boolean',
    })
    .registerSetting({
      setting: 'blomstra-gdpr.default-erasure',
      label: app.translator.trans('blomstra-gdpr.admin.settings.default_erasure'),
      help: app.translator.trans('blomstra-gdpr.admin.settings.default_erasure_help'),
      type: 'select',
      options: {
        anonymization: app.translator.trans('blomstra-gdpr.admin.settings.default_erasure_options.anonymization'),
        deletion: app.translator.trans('blomstra-gdpr.admin.settings.default_erasure_options.deletion'),
      },
    })
    .registerPermission(
      {
        icon: 'fas fa-user-minus',
        label: app.translator.trans('blomstra-gdpr.admin.permissions.process_erasure'),
        permission: 'processErasure',
      },
      'moderate'
    )
    .registerPermission(
      {
        icon: 'fas fa-file-export',
        label: app.translator.trans('blomstra-gdpr.admin.permissions.process_export_for_others'),
        permission: 'moderateExport',
      },
      'moderate'
    );

  extendUserListPage();
  extendAdminNav();
});
