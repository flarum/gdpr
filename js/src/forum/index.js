import { extend } from 'flarum/extend';
import SettingsPage from 'flarum/components/SettingsPage';
import Button from 'flarum/components/Button';
import RequestDataModal from './components/RequestDataModal';

app.initializers.add(
    'blomstra-gdpr',
    () => {
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
