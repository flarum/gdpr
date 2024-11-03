import DeleteUserModal from './components/DeleteUserModal';
import ErasureRequestsDropdown from './components/ErasureRequestsDropdown';
import ErasureRequestsList from './components/ErasureRequestsList';
import ErasureRequestsPage from './components/ErasureRequestsPage';
import ExportAvailableNotification from './components/ExportAvailableNotification';
import ProcessErasureRequestModal from './components/ProcessErasureRequestModal';
import RequestErasureModal from './components/RequestErasureModal';
import ErasureRequestsListState from './states/ErasureRequestsListState';
declare const _default: {
    'gdpr/models/ErasureRequest': typeof import("../common/models/ErasureRequest").default;
    'gdpr/models/Export': typeof import("../common/models/Export").default;
    'gdpr/components/RequestDataExportModal': typeof import("../common/components/RequestDataExportModal").default;
} & {
    'gdpr/components/DeleteUserModal': typeof DeleteUserModal;
    'gdpr/components/ErasureRequestDropdown': typeof ErasureRequestsDropdown;
    'gdpr/components/ErasureRequestsList': typeof ErasureRequestsList;
    'gdpr/components/ErasureRequestsPage': typeof ErasureRequestsPage;
    'gdpr/components/ExportAvailableNotification': typeof ExportAvailableNotification;
    'gdpr/components/ProcessErasureRequestModal': typeof ProcessErasureRequestModal;
    'gdpr/components/RequestErasureModal': typeof RequestErasureModal;
    'gdpr/states/ErasureRequestListState': typeof ErasureRequestsListState;
};
export default _default;
