import { default as extend } from '../common/extend';
import Extend from 'flarum/common/extenders';
import GdprPage from './GdprPage';
import DataType from './models/DataType';

export default [
  ...extend,

  new Extend.Routes() //
    .add('gdpr', '/gdpr', GdprPage),

  new Extend.Store() //
    .add('gdpr-datatypes', DataType),
];
