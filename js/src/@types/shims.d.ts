import 'flarum/forum/ForumApplication';
import 'flarum/common/models/User';

declare module 'flarum/forum/ForumApplication' {
  import ErasureRequestsListState from '../forum/states/ErasureRequestsListState';

  export default interface ForumApplication {
    erasureRequests: ErasureRequestsListState;
  }
}
declare module 'flarum/common/models/User' {
  import User from 'flarum/common/models/User';
  import ErasureRequest from '../../common/models/ErasureRequest';

  export default interface User {
    canModerateExports(): boolean;
    anonymized(): boolean;
    erasureRequest: ErasureRequest;
  }
}
