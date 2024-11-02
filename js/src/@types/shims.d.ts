import 'flarum/forum/ForumApplication';

declare module 'flarum/forum/ForumApplication' {
  import ErasureRequestsListState from '../forum/states/ErasureRequestsListState';

  export default interface ForumApplication {
    erasureRequests: ErasureRequestsListState;
  }
}
