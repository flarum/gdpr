import Extend from 'flarum/common/extenders';
import User from 'flarum/common/models/User';
import ErasureRequest from './models/ErasureRequest';
import ErasureRequestsPage from './components/ErasureRequestsPage';
import Export from './models/Export';

export default [
  new Extend.Store() //
    .add('user-erasure-requests', ErasureRequest)
    .add('exports', Export),

  new Extend.Model(User) //
    .hasOne<ErasureRequest>('erasureRequest'),

  new Extend.Routes() //
    .add('erasure-requests', '/erasure-requests', ErasureRequestsPage)
    .add('gdpr.export', '/gdpr/export/:file', ''),
];