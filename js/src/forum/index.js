import { extend } from 'flarum/extend';
import Model from 'flarum/common/Model';
import Page from 'flarum/components/Page';
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


        extend(Page.prototype, 'oninit', function () {
            if (m.route.param('erasureRequestConfirmed')) {
                app.alerts.show({ type: 'success' }, app.translator.trans('blomstra-gdpr.forum.erasure_request_confirmed'));
            }
        });

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
