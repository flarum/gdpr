import ExtensionLink from './components/ExtensionLink';
import GdprPage from './components/GdprPage';
import DataType from './models/DataType';
declare const _default: {
    'gdpr/models/ErasureRequest': typeof import("../common/models/ErasureRequest").default;
    'gdpr/models/Export': typeof import("../common/models/Export").default;
    'gdpr/components/RequestDataExportModal': typeof import("../common/components/RequestDataExportModal").default;
} & {
    'gdpr/components/ExtensionLink': typeof ExtensionLink;
    'gdpr/components/GdprPage': typeof GdprPage;
    'gdpr/models/DataType': typeof DataType;
};
export default _default;
