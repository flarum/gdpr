import compat from '../common/compat';
import DeleteUserModal from './components/DeleteUserModal';
import ErasureRequestsDropdown from './components/ErasureRequestsDropdown';
import ErasureRequestsList from './components/ErasureRequestsList';
import ErasureRequestsPage from './components/ErasureRequestsPage';
import ExportAvailableNotification from './components/ExportAvailableNotification';
import ProcessErasureRequestModal from './components/ProcessErasureRequestModal';
import RequestErasureModal from './components/RequestErasureModal';
import ErasureRequestsListState from './states/ErasureRequestsListState';

export default Object.assign(compat, {
  'gdpr/components/DeleteUserModal': DeleteUserModal,
  'gdpr/components/ErasureRequestDropdown': ErasureRequestsDropdown,
  'gdpr/components/ErasureRequestsList': ErasureRequestsList,
  'gdpr/components/ErasureRequestsPage': ErasureRequestsPage,
  'gdpr/components/ExportAvailableNotification': ExportAvailableNotification,
  'gdpr/components/ProcessErasureRequestModal': ProcessErasureRequestModal,
  'gdpr/components/RequestErasureModal': RequestErasureModal,
  'gdpr/states/ErasureRequestListState': ErasureRequestsListState,
});
