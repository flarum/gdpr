import app from 'flarum/admin/app';
import extendUserListPage from './extendUserListPage';
import extendAdminNav from './extendAdminNav';
import LinkButton from 'flarum/common/components/LinkButton';

export { default as extend } from './extend';

app.initializers.add('blomstra-gdpr', () => {
  app.extensionData
    .for('blomstra-gdpr')
    .registerSetting(function () {
      return (
        <div className="Form-group">
          <h3>{app.translator.trans('blomstra-gdpr.admin.settings.gdpr_page.title')}</h3>
          <p className="helpText">{app.translator.trans('blomstra-gdpr.admin.settings.gdpr_page.help_text')}</p>
          <LinkButton href={app.route('gdpr')} icon="fas fa-user-shield" className="Button">
            {app.translator.trans('blomstra-gdpr.admin.nav.gdpr_button')}
          </LinkButton>
        </div>
      );
    })
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
    .registerSetting({
      setting: 'blomstra-gdpr.default-anonymous-username',
      type: 'string',
      label: app.translator.trans('blomstra-gdpr.admin.settings.default_anonymous_username'),
      help: app.translator.trans('blomstra-gdpr.admin.settings.default_anonymous_username_help'),
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
    )
    .registerPermission(
      {
        icon: 'fas fa-eye',
        label: app.translator.trans('blomstra-gdpr.admin.permissions.see_anonymized_user_badges'),
        permission: 'seeAnonymizedUserBadges',
        allowGuest: true,
      },
      'view'
    );

  extendUserListPage();
  extendAdminNav();
});
