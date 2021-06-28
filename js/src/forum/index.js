import app from 'flarum/forum/app';
import { extend } from 'flarum/common/extend';
import Model from 'flarum/common/Model';
import Button from 'flarum/common/components/Button';
import HeaderSecondary from 'flarum/forum/components/HeaderSecondary';
import Page from 'flarum/common/components/Page';
import SettingsPage from 'flarum/forum/components/SettingsPage';
import RequestDataModal from './components/RequestDataModal';
import RequestErasureModal from './components/RequestErasureModal';
import ErasureRequest from './models/ErasureRequest';
import ErasureRequestsPage from './components/ErasureRequestsPage';
import ErasureRequestsDropdown from './components/ErasureRequestsDropdown';
import ErasureRequestsListState from './states/ErasureRequestsListState';


app.initializers.add(
    'blomstra-gdpr',
    () => {
        app.store.models['user-erasure-requests'] = ErasureRequest;
        app.store.models.users.prototype.erasureRequest = Model.hasOne('erasureRequest');

        app.routes['erasure-requests'] = { path: '/erasure-requests', component: ErasureRequestsPage };

        app.erasureRequests = new ErasureRequestsListState(app);

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

        extend(HeaderSecondary.prototype, 'items', function (items) {
            if (app.forum.attribute('erasureRequestCount')) {
                items.add('UsernameRequests', <ErasureRequestsDropdown state={app.erasureRequests} />, 20);
            }
        });
    }
);
