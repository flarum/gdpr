import { extend } from 'flarum/extend';
import Model from 'flarum/common/Model';
import SettingsPage from 'flarum/components/SettingsPage';
import Button from 'flarum/components/Button';
import RequestDataModal from './components/RequestDataModal';
import RequestErasureModal from './components/RequestErasureModal';
import ErasureRequest from './models/ErasureRequest';

app.initializers.add(
    'blomstra-gdpr',
    () => {
        app.store.models['user-erasure-requests'] = ErasureRequest;
        app.store.models.users.prototype.erasureRequest = Model.hasOne('erasureRequest');

        extend(SettingsPage.prototype, 'accountItems', function (items) {
            items.add(
                'gdprErasure',
                Button.component({
                    className: 'Button',
                    onclick: () => app.modal.show(RequestErasureModal),
                }, app.translator.trans('blomstra-gdpr.forum.settings.request_erasure_button'))
            );
        });

        extend(SettingsPage.prototype, 'accountItems', function (items) {
            items.add(
                'gdprExport',
                Button.component({
                    className: 'Button',
                    onclick: () => app.modal.show(RequestDataModal),
                }, app.translator.trans('blomstra-gdpr.forum.settings.export_data_button'))
            );
        });
    }
);
