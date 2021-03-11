app.initializers.add(
    'blomstra-gdpr',
    () => {
        console.log('hi')
        app.extensionData
            .for('blomstra-gdpr')
            .registerSetting({
                setting: 'blomstra-gdpr.allow-anonymization',
                label: app.translator.trans('blomstra-gdpr.admin.settings.allow_anonymization'),
                type: 'boolean'
            })
            .registerSetting({
                setting: 'blomstra-gdpr.allow-deletion',
                label: app.translator.trans('blomstra-gdpr.admin.settings.allow_deletion'),
                type: 'boolean'
            })
            .registerSetting({
                setting: 'blomstra-gdpr.default-erasure',
                label: app.translator.trans('blomstra-gdpr.admin.settings.default_erasure'),
                type: 'select',
                options: {
                    anonymization: app.translator.trans('blomstra-gdpr.admin.settings.default_erasure_options.anonymization'),
                    deletion: app.translator.trans('blomstra-gdpr.admin.settings.default_erasure_options.deletion'),
                }
            })
            .registerPermission(
                {
                    icon: "fas fa-user-minus",
                    label: app.translator.trans("blomstra-gdpr.admin.permissions.process_erasure"),
                    permission: "user.processErasure",
                },
                "moderate"
            );
    }
);
