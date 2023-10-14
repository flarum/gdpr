import Extend from 'flarum/common/extenders';
import ErasureRequestsPage from './components/ErasureRequestsPage';

import { default as extend } from '../common/extend';

export default [
  ...extend,

  new Extend.Routes() //
    .add('erasure-requests', '/erasure-requests', ErasureRequestsPage)
    .add('gdpr.export', '/gdpr/export/:file', ''),
];
