import compat from '../common/compat';
import ExtensionLink from './components/ExtensionLink';
import GdprPage from './components/GdprPage';
import DataType from './models/DataType';

export default Object.assign(compat, {
  'gdpr/components/ExtensionLink': ExtensionLink,
  'gdpr/components/GdprPage': GdprPage,
  'gdpr/models/DataType': DataType,
});
