/******/ (() => { // webpackBootstrap
/******/ 	// runtime can't be in strict mode because a global variable is assign and maybe created.
/******/ 	var __webpack_modules__ = ({

/***/ "./src/admin/GdprPage.tsx":
/*!********************************!*\
  !*** ./src/admin/GdprPage.tsx ***!
  \********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ GdprPage)
/* harmony export */ });
/* harmony import */ var _babel_runtime_helpers_esm_inheritsLoose__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/helpers/esm/inheritsLoose */ "./node_modules/@babel/runtime/helpers/esm/inheritsLoose.js");
/* harmony import */ var flarum_admin_app__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! flarum/admin/app */ "flarum/admin/app");
/* harmony import */ var flarum_admin_app__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(flarum_admin_app__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var flarum_admin_components_AdminPage__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! flarum/admin/components/AdminPage */ "flarum/admin/components/AdminPage");
/* harmony import */ var flarum_admin_components_AdminPage__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(flarum_admin_components_AdminPage__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var flarum_common_components_LoadingIndicator__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! flarum/common/components/LoadingIndicator */ "flarum/common/components/LoadingIndicator");
/* harmony import */ var flarum_common_components_LoadingIndicator__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(flarum_common_components_LoadingIndicator__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var flarum_common_components_Tooltip__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! flarum/common/components/Tooltip */ "flarum/common/components/Tooltip");
/* harmony import */ var flarum_common_components_Tooltip__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(flarum_common_components_Tooltip__WEBPACK_IMPORTED_MODULE_4__);
/* harmony import */ var _components_ExtensionLink__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./components/ExtensionLink */ "./src/admin/components/ExtensionLink.tsx");
/* harmony import */ var flarum_common_components_LinkButton__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! flarum/common/components/LinkButton */ "flarum/common/components/LinkButton");
/* harmony import */ var flarum_common_components_LinkButton__WEBPACK_IMPORTED_MODULE_6___default = /*#__PURE__*/__webpack_require__.n(flarum_common_components_LinkButton__WEBPACK_IMPORTED_MODULE_6__);







var GdprPage = /*#__PURE__*/function (_AdminPage) {
  function GdprPage() {
    var _this;
    for (var _len = arguments.length, args = new Array(_len), _key = 0; _key < _len; _key++) {
      args[_key] = arguments[_key];
    }
    _this = _AdminPage.call.apply(_AdminPage, [this].concat(args)) || this;
    _this.gdprDataTypes = [];
    return _this;
  }
  (0,_babel_runtime_helpers_esm_inheritsLoose__WEBPACK_IMPORTED_MODULE_0__["default"])(GdprPage, _AdminPage);
  var _proto = GdprPage.prototype;
  _proto.oninit = function oninit(vnode) {
    _AdminPage.prototype.oninit.call(this, vnode);
    this.loadGdprDataTypes();
  };
  _proto.headerInfo = function headerInfo() {
    return {
      className: 'GdprPage--header',
      icon: 'fas fa-user-shield',
      title: flarum_admin_app__WEBPACK_IMPORTED_MODULE_1___default().translator.trans('blomstra-gdpr.admin.gdpr_page.heading'),
      description: flarum_admin_app__WEBPACK_IMPORTED_MODULE_1___default().translator.trans('blomstra-gdpr.admin.gdpr_page.description')
    };
  };
  _proto.loadGdprDataTypes = function loadGdprDataTypes() {
    var _this2 = this;
    this.loading = true;
    flarum_admin_app__WEBPACK_IMPORTED_MODULE_1___default().store.find('gdpr/datatypes').then(function (dataTypes) {
      _this2.gdprDataTypes = dataTypes;
      _this2.loading = false;
      m.redraw();
    });
  };
  _proto.content = function content() {
    if (this.loading) {
      return m((flarum_common_components_LoadingIndicator__WEBPACK_IMPORTED_MODULE_3___default()), null);
    }
    return m("div", {
      className: "GdprPage"
    }, m("h3", null, flarum_admin_app__WEBPACK_IMPORTED_MODULE_1___default().translator.trans('blomstra-gdpr.admin.gdpr_page.settings.heading')), m("p", {
      className: "helpText"
    }, flarum_admin_app__WEBPACK_IMPORTED_MODULE_1___default().translator.trans('blomstra-gdpr.admin.gdpr_page.settings.help_text')), m((flarum_common_components_LinkButton__WEBPACK_IMPORTED_MODULE_6___default()), {
      className: "Button",
      href: flarum_admin_app__WEBPACK_IMPORTED_MODULE_1___default().route('extension', {
        id: 'blomstra-gdpr'
      })
    }, flarum_admin_app__WEBPACK_IMPORTED_MODULE_1___default().translator.trans('blomstra-gdpr.admin.gdpr_page.settings.extension_settings_button')), m("hr", null), m("h3", null, flarum_admin_app__WEBPACK_IMPORTED_MODULE_1___default().translator.trans('blomstra-gdpr.admin.gdpr_page.data_types.title')), m("p", {
      className: "helpText"
    }, flarum_admin_app__WEBPACK_IMPORTED_MODULE_1___default().translator.trans('blomstra-gdpr.admin.gdpr_page.data_types.help_text')), m("div", {
      className: "GdprGrid"
    }, m("div", {
      "class": "GdprGrid-row"
    }, m("div", {
      className: "GdprGrid-header"
    }, flarum_admin_app__WEBPACK_IMPORTED_MODULE_1___default().translator.trans('blomstra-gdpr.admin.gdpr_page.data_types.type')), m("div", {
      className: "GdprGrid-header"
    }, flarum_admin_app__WEBPACK_IMPORTED_MODULE_1___default().translator.trans('blomstra-gdpr.admin.gdpr_page.data_types.export_description')), m("div", {
      className: "GdprGrid-header"
    }, flarum_admin_app__WEBPACK_IMPORTED_MODULE_1___default().translator.trans('blomstra-gdpr.admin.gdpr_page.data_types.anonymize_description')), m("div", {
      className: "GdprGrid-header"
    }, flarum_admin_app__WEBPACK_IMPORTED_MODULE_1___default().translator.trans('blomstra-gdpr.admin.gdpr_page.data_types.delete_description')), m("div", {
      className: "GdprGrid-header"
    }, flarum_admin_app__WEBPACK_IMPORTED_MODULE_1___default().translator.trans('blomstra-gdpr.admin.gdpr_page.data_types.extension'))), this.gdprDataTypes.map(function (dataType) {
      return m('[', null, m("div", {
        "class": "GdprGrid-row"
      }, m("div", null, m((flarum_common_components_Tooltip__WEBPACK_IMPORTED_MODULE_4___default()), {
        text: dataType.id()
      }, m("span", {
        className: "helpText"
      }, dataType.type()))), m("div", {
        className: "helpText"
      }, dataType.exportDescription()), m("div", {
        className: "helpText"
      }, dataType.anonymizeDescription()), m("div", {
        className: "helpText"
      }, dataType.deleteDescription()), m("div", null, m(_components_ExtensionLink__WEBPACK_IMPORTED_MODULE_5__["default"], {
        extension: (flarum_admin_app__WEBPACK_IMPORTED_MODULE_1___default().data).extensions[dataType.extension()]
      }))));
    })), m("hr", null), m("h3", null, flarum_admin_app__WEBPACK_IMPORTED_MODULE_1___default().translator.trans('blomstra-gdpr.admin.gdpr_page.user_table_data.title')), m("p", {
      className: "helpText"
    }, flarum_admin_app__WEBPACK_IMPORTED_MODULE_1___default().translator.trans('blomstra-gdpr.admin.gdpr_page.user_table_data.help_text')), m("div", {
      className: "GdprUserColumnData"
    }, "Not yet implemented"));
  };
  return GdprPage;
}((flarum_admin_components_AdminPage__WEBPACK_IMPORTED_MODULE_2___default()));


/***/ }),

/***/ "./src/admin/components/ExtensionLink.tsx":
/*!************************************************!*\
  !*** ./src/admin/components/ExtensionLink.tsx ***!
  \************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ ExtensionLink)
/* harmony export */ });
/* harmony import */ var _babel_runtime_helpers_esm_inheritsLoose__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/helpers/esm/inheritsLoose */ "./node_modules/@babel/runtime/helpers/esm/inheritsLoose.js");
/* harmony import */ var flarum_common_components_LinkButton__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! flarum/common/components/LinkButton */ "flarum/common/components/LinkButton");
/* harmony import */ var flarum_common_components_LinkButton__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(flarum_common_components_LinkButton__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var flarum_admin_app__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! flarum/admin/app */ "flarum/admin/app");
/* harmony import */ var flarum_admin_app__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(flarum_admin_app__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var flarum_common_Component__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! flarum/common/Component */ "flarum/common/Component");
/* harmony import */ var flarum_common_Component__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(flarum_common_Component__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var flarum_common_components_Tooltip__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! flarum/common/components/Tooltip */ "flarum/common/components/Tooltip");
/* harmony import */ var flarum_common_components_Tooltip__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(flarum_common_components_Tooltip__WEBPACK_IMPORTED_MODULE_4__);
/* harmony import */ var flarum_common_helpers_icon__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! flarum/common/helpers/icon */ "flarum/common/helpers/icon");
/* harmony import */ var flarum_common_helpers_icon__WEBPACK_IMPORTED_MODULE_5___default = /*#__PURE__*/__webpack_require__.n(flarum_common_helpers_icon__WEBPACK_IMPORTED_MODULE_5__);






var ExtensionLink = /*#__PURE__*/function (_Component) {
  function ExtensionLink() {
    return _Component.apply(this, arguments) || this;
  }
  (0,_babel_runtime_helpers_esm_inheritsLoose__WEBPACK_IMPORTED_MODULE_0__["default"])(ExtensionLink, _Component);
  var _proto = ExtensionLink.prototype;
  _proto.view = function view() {
    var extension = this.attrs.extension;
    if (!extension) {
      return null;
    }
    return m((flarum_common_components_Tooltip__WEBPACK_IMPORTED_MODULE_4___default()), {
      text: extension.extra['flarum-extension'].title
    }, m((flarum_common_components_LinkButton__WEBPACK_IMPORTED_MODULE_1___default()), {
      href: flarum_admin_app__WEBPACK_IMPORTED_MODULE_2___default().route('extension', {
        id: extension.id
      })
    }, m("span", {
      className: "ExtensionIcon ExtensionIcon--gdpr",
      style: extension.icon
    }, !!extension.icon && flarum_common_helpers_icon__WEBPACK_IMPORTED_MODULE_5___default()(extension.icon.name))));
  };
  return ExtensionLink;
}((flarum_common_Component__WEBPACK_IMPORTED_MODULE_3___default()));


/***/ }),

/***/ "./src/admin/extend.ts":
/*!*****************************!*\
  !*** ./src/admin/extend.ts ***!
  \*****************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _common_extend__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../common/extend */ "./src/common/extend.ts");
/* harmony import */ var flarum_common_extenders__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! flarum/common/extenders */ "flarum/common/extenders");
/* harmony import */ var flarum_common_extenders__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(flarum_common_extenders__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _GdprPage__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./GdprPage */ "./src/admin/GdprPage.tsx");
/* harmony import */ var _models_DataType__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./models/DataType */ "./src/admin/models/DataType.tsx");




/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ([].concat(_common_extend__WEBPACK_IMPORTED_MODULE_0__["default"], [new (flarum_common_extenders__WEBPACK_IMPORTED_MODULE_1___default().Routes)() //
.add('gdpr', '/gdpr', _GdprPage__WEBPACK_IMPORTED_MODULE_2__["default"]), new (flarum_common_extenders__WEBPACK_IMPORTED_MODULE_1___default().Store)() //
.add('gdpr-datatypes', _models_DataType__WEBPACK_IMPORTED_MODULE_3__["default"])]));

/***/ }),

/***/ "./src/admin/extendAdminNav.tsx":
/*!**************************************!*\
  !*** ./src/admin/extendAdminNav.tsx ***!
  \**************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ extendAdminNav)
/* harmony export */ });
/* harmony import */ var flarum_admin_app__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! flarum/admin/app */ "flarum/admin/app");
/* harmony import */ var flarum_admin_app__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(flarum_admin_app__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var flarum_common_extend__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! flarum/common/extend */ "flarum/common/extend");
/* harmony import */ var flarum_common_extend__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(flarum_common_extend__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var flarum_admin_components_AdminNav__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! flarum/admin/components/AdminNav */ "flarum/admin/components/AdminNav");
/* harmony import */ var flarum_admin_components_AdminNav__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(flarum_admin_components_AdminNav__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var flarum_common_components_LinkButton__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! flarum/common/components/LinkButton */ "flarum/common/components/LinkButton");
/* harmony import */ var flarum_common_components_LinkButton__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(flarum_common_components_LinkButton__WEBPACK_IMPORTED_MODULE_3__);




function extendAdminNav() {
  (0,flarum_common_extend__WEBPACK_IMPORTED_MODULE_1__.extend)((flarum_admin_components_AdminNav__WEBPACK_IMPORTED_MODULE_2___default().prototype), 'items', function (items) {
    items.add('gdpr', m((flarum_common_components_LinkButton__WEBPACK_IMPORTED_MODULE_3___default()), {
      href: flarum_admin_app__WEBPACK_IMPORTED_MODULE_0___default().route('gdpr'),
      icon: "fas fa-user-shield",
      title: flarum_admin_app__WEBPACK_IMPORTED_MODULE_0___default().translator.trans('blomstra-gdpr.admin.gdpr.title')
    }, flarum_admin_app__WEBPACK_IMPORTED_MODULE_0___default().translator.trans('blomstra-gdpr.admin.nav.gdpr_button')), 48);
  });
}

/***/ }),

/***/ "./src/admin/extendUserListPage.tsx":
/*!******************************************!*\
  !*** ./src/admin/extendUserListPage.tsx ***!
  \******************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ extendUserListPage)
/* harmony export */ });
/* harmony import */ var flarum_admin_app__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! flarum/admin/app */ "flarum/admin/app");
/* harmony import */ var flarum_admin_app__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(flarum_admin_app__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var flarum_common_extend__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! flarum/common/extend */ "flarum/common/extend");
/* harmony import */ var flarum_common_extend__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(flarum_common_extend__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var flarum_admin_components_UserListPage__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! flarum/admin/components/UserListPage */ "flarum/admin/components/UserListPage");
/* harmony import */ var flarum_admin_components_UserListPage__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(flarum_admin_components_UserListPage__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var flarum_common_utils_ItemList__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! flarum/common/utils/ItemList */ "flarum/common/utils/ItemList");
/* harmony import */ var flarum_common_utils_ItemList__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(flarum_common_utils_ItemList__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var flarum_common_components_Tooltip__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! flarum/common/components/Tooltip */ "flarum/common/components/Tooltip");
/* harmony import */ var flarum_common_components_Tooltip__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(flarum_common_components_Tooltip__WEBPACK_IMPORTED_MODULE_4__);
/* harmony import */ var flarum_common_components_Button__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! flarum/common/components/Button */ "flarum/common/components/Button");
/* harmony import */ var flarum_common_components_Button__WEBPACK_IMPORTED_MODULE_5___default = /*#__PURE__*/__webpack_require__.n(flarum_common_components_Button__WEBPACK_IMPORTED_MODULE_5__);
/* harmony import */ var flarum_common_helpers_username__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! flarum/common/helpers/username */ "flarum/common/helpers/username");
/* harmony import */ var flarum_common_helpers_username__WEBPACK_IMPORTED_MODULE_6___default = /*#__PURE__*/__webpack_require__.n(flarum_common_helpers_username__WEBPACK_IMPORTED_MODULE_6__);
/* harmony import */ var _common_components_RequestDataExportModal__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! ../common/components/RequestDataExportModal */ "./src/common/components/RequestDataExportModal.tsx");








function extendUserListPage() {
  (0,flarum_common_extend__WEBPACK_IMPORTED_MODULE_1__.extend)((flarum_admin_components_UserListPage__WEBPACK_IMPORTED_MODULE_2___default().prototype), 'columns', function (columns) {
    var _this = this;
    columns.add('gdpr', {
      name: flarum_admin_app__WEBPACK_IMPORTED_MODULE_0___default().translator.trans('blomstra-gdpr.admin.userlist.columns.gdpr_actions.title'),
      content: function content(user) {
        return m("div", {
          className: "gdprActions"
        }, _this.gdprActions(user).toArray());
      }
    }, 50);
  });
  (flarum_admin_components_UserListPage__WEBPACK_IMPORTED_MODULE_2___default().prototype).gdprActions = function (user) {
    var items = new (flarum_common_utils_ItemList__WEBPACK_IMPORTED_MODULE_3___default())();
    if (user.canModerateExports()) {
      items.add('export-data', m((flarum_common_components_Tooltip__WEBPACK_IMPORTED_MODULE_4___default()), {
        text: flarum_admin_app__WEBPACK_IMPORTED_MODULE_0___default().translator.trans('blomstra-gdpr.admin.userlist.columns.gdpr_actions.export', {
          username: flarum_common_helpers_username__WEBPACK_IMPORTED_MODULE_6___default()(user)
        })
      }, m((flarum_common_components_Button__WEBPACK_IMPORTED_MODULE_5___default()), {
        className: "Button Button--icon",
        icon: "fas fa-file-export",
        onclick: function onclick() {
          return flarum_admin_app__WEBPACK_IMPORTED_MODULE_0___default().modal.show(_common_components_RequestDataExportModal__WEBPACK_IMPORTED_MODULE_7__["default"], {
            user: user
          });
        }
      })));
    }
    return items;
  };
}

/***/ }),

/***/ "./src/admin/index.tsx":
/*!*****************************!*\
  !*** ./src/admin/index.tsx ***!
  \*****************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   extend: () => (/* reexport safe */ _extend__WEBPACK_IMPORTED_MODULE_4__["default"])
/* harmony export */ });
/* harmony import */ var flarum_admin_app__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! flarum/admin/app */ "flarum/admin/app");
/* harmony import */ var flarum_admin_app__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(flarum_admin_app__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _extendUserListPage__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./extendUserListPage */ "./src/admin/extendUserListPage.tsx");
/* harmony import */ var _extendAdminNav__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./extendAdminNav */ "./src/admin/extendAdminNav.tsx");
/* harmony import */ var flarum_common_components_LinkButton__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! flarum/common/components/LinkButton */ "flarum/common/components/LinkButton");
/* harmony import */ var flarum_common_components_LinkButton__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(flarum_common_components_LinkButton__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var _extend__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./extend */ "./src/admin/extend.ts");





flarum_admin_app__WEBPACK_IMPORTED_MODULE_0___default().initializers.add('blomstra-gdpr', function () {
  flarum_admin_app__WEBPACK_IMPORTED_MODULE_0___default().extensionData["for"]('blomstra-gdpr').registerSetting(function () {
    return m("div", {
      className: "Form-group"
    }, m("h3", null, flarum_admin_app__WEBPACK_IMPORTED_MODULE_0___default().translator.trans('blomstra-gdpr.admin.settings.gdpr_page.title')), m("p", {
      className: "helpText"
    }, flarum_admin_app__WEBPACK_IMPORTED_MODULE_0___default().translator.trans('blomstra-gdpr.admin.settings.gdpr_page.help_text')), m((flarum_common_components_LinkButton__WEBPACK_IMPORTED_MODULE_3___default()), {
      href: flarum_admin_app__WEBPACK_IMPORTED_MODULE_0___default().route('gdpr'),
      icon: "fas fa-user-shield",
      className: "Button"
    }, flarum_admin_app__WEBPACK_IMPORTED_MODULE_0___default().translator.trans('blomstra-gdpr.admin.nav.gdpr_button')));
  }).registerSetting({
    setting: 'blomstra-gdpr.allow-anonymization',
    label: flarum_admin_app__WEBPACK_IMPORTED_MODULE_0___default().translator.trans('blomstra-gdpr.admin.settings.allow_anonymization'),
    help: flarum_admin_app__WEBPACK_IMPORTED_MODULE_0___default().translator.trans('blomstra-gdpr.admin.settings.allow_anonymization_help'),
    type: 'boolean'
  }).registerSetting({
    setting: 'blomstra-gdpr.allow-deletion',
    label: flarum_admin_app__WEBPACK_IMPORTED_MODULE_0___default().translator.trans('blomstra-gdpr.admin.settings.allow_deletion'),
    help: flarum_admin_app__WEBPACK_IMPORTED_MODULE_0___default().translator.trans('blomstra-gdpr.admin.settings.allow_deletion_help'),
    type: 'boolean'
  }).registerSetting({
    setting: 'blomstra-gdpr.default-erasure',
    label: flarum_admin_app__WEBPACK_IMPORTED_MODULE_0___default().translator.trans('blomstra-gdpr.admin.settings.default_erasure'),
    help: flarum_admin_app__WEBPACK_IMPORTED_MODULE_0___default().translator.trans('blomstra-gdpr.admin.settings.default_erasure_help'),
    type: 'select',
    options: {
      anonymization: flarum_admin_app__WEBPACK_IMPORTED_MODULE_0___default().translator.trans('blomstra-gdpr.admin.settings.default_erasure_options.anonymization'),
      deletion: flarum_admin_app__WEBPACK_IMPORTED_MODULE_0___default().translator.trans('blomstra-gdpr.admin.settings.default_erasure_options.deletion')
    }
  }).registerSetting({
    setting: 'blomstra-gdpr.default-anonymous-username',
    type: 'string',
    label: flarum_admin_app__WEBPACK_IMPORTED_MODULE_0___default().translator.trans('blomstra-gdpr.admin.settings.default_anonymous_username'),
    help: flarum_admin_app__WEBPACK_IMPORTED_MODULE_0___default().translator.trans('blomstra-gdpr.admin.settings.default_anonymous_username_help')
  }).registerPermission({
    icon: 'fas fa-user-minus',
    label: flarum_admin_app__WEBPACK_IMPORTED_MODULE_0___default().translator.trans('blomstra-gdpr.admin.permissions.process_erasure'),
    permission: 'processErasure'
  }, 'moderate').registerPermission({
    icon: 'fas fa-file-export',
    label: flarum_admin_app__WEBPACK_IMPORTED_MODULE_0___default().translator.trans('blomstra-gdpr.admin.permissions.process_export_for_others'),
    permission: 'moderateExport'
  }, 'moderate').registerPermission({
    icon: 'fas fa-eye',
    label: flarum_admin_app__WEBPACK_IMPORTED_MODULE_0___default().translator.trans('blomstra-gdpr.admin.permissions.see_anonymized_user_badges'),
    permission: 'seeAnonymizedUserBadges',
    allowGuest: true
  }, 'view');
  (0,_extendUserListPage__WEBPACK_IMPORTED_MODULE_1__["default"])();
  (0,_extendAdminNav__WEBPACK_IMPORTED_MODULE_2__["default"])();
});

/***/ }),

/***/ "./src/admin/models/DataType.tsx":
/*!***************************************!*\
  !*** ./src/admin/models/DataType.tsx ***!
  \***************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ DataType)
/* harmony export */ });
/* harmony import */ var _babel_runtime_helpers_esm_inheritsLoose__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/helpers/esm/inheritsLoose */ "./node_modules/@babel/runtime/helpers/esm/inheritsLoose.js");
/* harmony import */ var flarum_common_Model__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! flarum/common/Model */ "flarum/common/Model");
/* harmony import */ var flarum_common_Model__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(flarum_common_Model__WEBPACK_IMPORTED_MODULE_1__);


var DataType = /*#__PURE__*/function (_Model) {
  function DataType() {
    return _Model.apply(this, arguments) || this;
  }
  (0,_babel_runtime_helpers_esm_inheritsLoose__WEBPACK_IMPORTED_MODULE_0__["default"])(DataType, _Model);
  var _proto = DataType.prototype;
  _proto.type = function type() {
    return flarum_common_Model__WEBPACK_IMPORTED_MODULE_1___default().attribute('type').call(this);
  };
  _proto.exportDescription = function exportDescription() {
    return flarum_common_Model__WEBPACK_IMPORTED_MODULE_1___default().attribute('exportDescription').call(this);
  };
  _proto.anonymizeDescription = function anonymizeDescription() {
    return flarum_common_Model__WEBPACK_IMPORTED_MODULE_1___default().attribute('anonymizeDescription').call(this);
  };
  _proto.deleteDescription = function deleteDescription() {
    return flarum_common_Model__WEBPACK_IMPORTED_MODULE_1___default().attribute('deleteDescription').call(this);
  };
  _proto.extension = function extension() {
    return flarum_common_Model__WEBPACK_IMPORTED_MODULE_1___default().attribute('extension').call(this);
  };
  return DataType;
}((flarum_common_Model__WEBPACK_IMPORTED_MODULE_1___default()));


/***/ }),

/***/ "./src/common/components/RequestDataExportModal.tsx":
/*!**********************************************************!*\
  !*** ./src/common/components/RequestDataExportModal.tsx ***!
  \**********************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ RequestDataExportModal)
/* harmony export */ });
/* harmony import */ var _babel_runtime_helpers_esm_inheritsLoose__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/helpers/esm/inheritsLoose */ "./node_modules/@babel/runtime/helpers/esm/inheritsLoose.js");
/* harmony import */ var flarum_common_app__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! flarum/common/app */ "flarum/common/app");
/* harmony import */ var flarum_common_app__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(flarum_common_app__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var flarum_common_components_Modal__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! flarum/common/components/Modal */ "flarum/common/components/Modal");
/* harmony import */ var flarum_common_components_Modal__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(flarum_common_components_Modal__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var flarum_common_components_Button__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! flarum/common/components/Button */ "flarum/common/components/Button");
/* harmony import */ var flarum_common_components_Button__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(flarum_common_components_Button__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var flarum_common_helpers_username__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! flarum/common/helpers/username */ "flarum/common/helpers/username");
/* harmony import */ var flarum_common_helpers_username__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(flarum_common_helpers_username__WEBPACK_IMPORTED_MODULE_4__);
/* harmony import */ var flarum_common_helpers_avatar__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! flarum/common/helpers/avatar */ "flarum/common/helpers/avatar");
/* harmony import */ var flarum_common_helpers_avatar__WEBPACK_IMPORTED_MODULE_5___default = /*#__PURE__*/__webpack_require__.n(flarum_common_helpers_avatar__WEBPACK_IMPORTED_MODULE_5__);






var RequestDataExportModal = /*#__PURE__*/function (_Modal) {
  function RequestDataExportModal() {
    var _this;
    for (var _len = arguments.length, args = new Array(_len), _key = 0; _key < _len; _key++) {
      args[_key] = arguments[_key];
    }
    _this = _Modal.call.apply(_Modal, [this].concat(args)) || this;
    _this.user = void 0;
    return _this;
  }
  (0,_babel_runtime_helpers_esm_inheritsLoose__WEBPACK_IMPORTED_MODULE_0__["default"])(RequestDataExportModal, _Modal);
  var _proto = RequestDataExportModal.prototype;
  _proto.oninit = function oninit(vnode) {
    _Modal.prototype.oninit.call(this, vnode);
    this.user = this.attrs.user;
  };
  _proto.className = function className() {
    return 'RequestDataModal Modal--small';
  };
  _proto.title = function title() {
    return flarum_common_app__WEBPACK_IMPORTED_MODULE_1___default().translator.trans('blomstra-gdpr.lib.request_data.title', {
      username: flarum_common_helpers_username__WEBPACK_IMPORTED_MODULE_4___default()(this.user)
    });
  };
  _proto.content = function content() {
    var _this2 = this;
    return m("div", {
      className: "Modal-body"
    }, m("div", {
      className: "Form Form--centered"
    }, m("div", {
      className: "User"
    }, flarum_common_helpers_avatar__WEBPACK_IMPORTED_MODULE_5___default()(this.user)), m("p", {
      className: "helpText"
    }, flarum_common_app__WEBPACK_IMPORTED_MODULE_1___default().translator.trans('blomstra-gdpr.lib.request_data.text')), m("div", {
      className: "Form-group"
    }, m((flarum_common_components_Button__WEBPACK_IMPORTED_MODULE_3___default()), {
      className: "Button Button--primary Button--block",
      onclick: function onclick() {
        return _this2.requestExport();
      },
      loading: this.loading,
      disabled: this.loading
    }, flarum_common_app__WEBPACK_IMPORTED_MODULE_1___default().translator.trans('blomstra-gdpr.lib.request_data.request_button')))));
  };
  _proto.requestExport = function requestExport() {
    this.loading = true;
    flarum_common_app__WEBPACK_IMPORTED_MODULE_1___default().request({
      method: 'POST',
      url: flarum_common_app__WEBPACK_IMPORTED_MODULE_1___default().forum.attribute('apiUrl') + '/gdpr/export',
      body: {
        data: {
          attributes: {
            userId: this.user.id()
          }
        }
      }
    }).then(this.hide.bind(this), this.loaded.bind(this));
  };
  return RequestDataExportModal;
}((flarum_common_components_Modal__WEBPACK_IMPORTED_MODULE_2___default()));


/***/ }),

/***/ "./src/common/extend.ts":
/*!******************************!*\
  !*** ./src/common/extend.ts ***!
  \******************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var flarum_common_extenders__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! flarum/common/extenders */ "flarum/common/extenders");
/* harmony import */ var flarum_common_extenders__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(flarum_common_extenders__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var flarum_common_models_User__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! flarum/common/models/User */ "flarum/common/models/User");
/* harmony import */ var flarum_common_models_User__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(flarum_common_models_User__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _models_ErasureRequest__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./models/ErasureRequest */ "./src/common/models/ErasureRequest.ts");
/* harmony import */ var _models_Export__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./models/Export */ "./src/common/models/Export.ts");




/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ([new (flarum_common_extenders__WEBPACK_IMPORTED_MODULE_0___default().Store)() //
.add('user-erasure-requests', _models_ErasureRequest__WEBPACK_IMPORTED_MODULE_2__["default"]).add('exports', _models_Export__WEBPACK_IMPORTED_MODULE_3__["default"]), new (flarum_common_extenders__WEBPACK_IMPORTED_MODULE_0___default().Model)((flarum_common_models_User__WEBPACK_IMPORTED_MODULE_1___default())) //
.attribute('canModerateExports').attribute('anonymized').hasOne('erasureRequest')]);

/***/ }),

/***/ "./src/common/models/ErasureRequest.ts":
/*!*********************************************!*\
  !*** ./src/common/models/ErasureRequest.ts ***!
  \*********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ ErasureRequest)
/* harmony export */ });
/* harmony import */ var _babel_runtime_helpers_esm_inheritsLoose__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/helpers/esm/inheritsLoose */ "./node_modules/@babel/runtime/helpers/esm/inheritsLoose.js");
/* harmony import */ var flarum_common_Model__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! flarum/common/Model */ "flarum/common/Model");
/* harmony import */ var flarum_common_Model__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(flarum_common_Model__WEBPACK_IMPORTED_MODULE_1__);


var ErasureRequest = /*#__PURE__*/function (_Model) {
  function ErasureRequest() {
    return _Model.apply(this, arguments) || this;
  }
  (0,_babel_runtime_helpers_esm_inheritsLoose__WEBPACK_IMPORTED_MODULE_0__["default"])(ErasureRequest, _Model);
  var _proto = ErasureRequest.prototype;
  _proto.status = function status() {
    return flarum_common_Model__WEBPACK_IMPORTED_MODULE_1___default().attribute('status').call(this);
  };
  _proto.reason = function reason() {
    return flarum_common_Model__WEBPACK_IMPORTED_MODULE_1___default().attribute('reason').call(this);
  };
  _proto.createdAt = function createdAt() {
    return flarum_common_Model__WEBPACK_IMPORTED_MODULE_1___default().attribute('createdAt', (flarum_common_Model__WEBPACK_IMPORTED_MODULE_1___default().transformDate)).call(this);
  };
  _proto.userConfirmedAt = function userConfirmedAt() {
    return flarum_common_Model__WEBPACK_IMPORTED_MODULE_1___default().attribute('userConfirmedAt', (flarum_common_Model__WEBPACK_IMPORTED_MODULE_1___default().transformDate)).call(this);
  };
  _proto.processedAt = function processedAt() {
    return flarum_common_Model__WEBPACK_IMPORTED_MODULE_1___default().attribute('processedAt', (flarum_common_Model__WEBPACK_IMPORTED_MODULE_1___default().transformDate)).call(this);
  };
  _proto.processorComment = function processorComment() {
    return flarum_common_Model__WEBPACK_IMPORTED_MODULE_1___default().attribute('processorComment').call(this);
  };
  _proto.processedMode = function processedMode() {
    return flarum_common_Model__WEBPACK_IMPORTED_MODULE_1___default().attribute('processedMode').call(this);
  };
  _proto.user = function user() {
    return flarum_common_Model__WEBPACK_IMPORTED_MODULE_1___default().hasOne('user').call(this);
  };
  _proto.processedBy = function processedBy() {
    return flarum_common_Model__WEBPACK_IMPORTED_MODULE_1___default().hasOne('processedBy').call(this);
  };
  return ErasureRequest;
}((flarum_common_Model__WEBPACK_IMPORTED_MODULE_1___default()));


/***/ }),

/***/ "./src/common/models/Export.ts":
/*!*************************************!*\
  !*** ./src/common/models/Export.ts ***!
  \*************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ Export)
/* harmony export */ });
/* harmony import */ var _babel_runtime_helpers_esm_inheritsLoose__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/helpers/esm/inheritsLoose */ "./node_modules/@babel/runtime/helpers/esm/inheritsLoose.js");
/* harmony import */ var flarum_common_Model__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! flarum/common/Model */ "flarum/common/Model");
/* harmony import */ var flarum_common_Model__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(flarum_common_Model__WEBPACK_IMPORTED_MODULE_1__);


var Export = /*#__PURE__*/function (_Model) {
  function Export() {
    return _Model.apply(this, arguments) || this;
  }
  (0,_babel_runtime_helpers_esm_inheritsLoose__WEBPACK_IMPORTED_MODULE_0__["default"])(Export, _Model);
  var _proto = Export.prototype;
  _proto.file = function file() {
    return flarum_common_Model__WEBPACK_IMPORTED_MODULE_1___default().attribute('file').call(this);
  };
  _proto.createdAt = function createdAt() {
    return flarum_common_Model__WEBPACK_IMPORTED_MODULE_1___default().attribute('createdAt', (flarum_common_Model__WEBPACK_IMPORTED_MODULE_1___default().transformDate));
  };
  _proto.destroysAt = function destroysAt() {
    return flarum_common_Model__WEBPACK_IMPORTED_MODULE_1___default().attribute('destroysAt', (flarum_common_Model__WEBPACK_IMPORTED_MODULE_1___default().transformDate));
  };
  _proto.user = function user() {
    return flarum_common_Model__WEBPACK_IMPORTED_MODULE_1___default().hasOne('user');
  };
  _proto.actor = function actor() {
    return flarum_common_Model__WEBPACK_IMPORTED_MODULE_1___default().hasOne('actor');
  };
  return Export;
}((flarum_common_Model__WEBPACK_IMPORTED_MODULE_1___default()));


/***/ }),

/***/ "flarum/admin/app":
/*!**************************************************!*\
  !*** external "flarum.core.compat['admin/app']" ***!
  \**************************************************/
/***/ ((module) => {

"use strict";
module.exports = flarum.core.compat['admin/app'];

/***/ }),

/***/ "flarum/admin/components/AdminNav":
/*!******************************************************************!*\
  !*** external "flarum.core.compat['admin/components/AdminNav']" ***!
  \******************************************************************/
/***/ ((module) => {

"use strict";
module.exports = flarum.core.compat['admin/components/AdminNav'];

/***/ }),

/***/ "flarum/admin/components/AdminPage":
/*!*******************************************************************!*\
  !*** external "flarum.core.compat['admin/components/AdminPage']" ***!
  \*******************************************************************/
/***/ ((module) => {

"use strict";
module.exports = flarum.core.compat['admin/components/AdminPage'];

/***/ }),

/***/ "flarum/admin/components/UserListPage":
/*!**********************************************************************!*\
  !*** external "flarum.core.compat['admin/components/UserListPage']" ***!
  \**********************************************************************/
/***/ ((module) => {

"use strict";
module.exports = flarum.core.compat['admin/components/UserListPage'];

/***/ }),

/***/ "flarum/common/Component":
/*!*********************************************************!*\
  !*** external "flarum.core.compat['common/Component']" ***!
  \*********************************************************/
/***/ ((module) => {

"use strict";
module.exports = flarum.core.compat['common/Component'];

/***/ }),

/***/ "flarum/common/Model":
/*!*****************************************************!*\
  !*** external "flarum.core.compat['common/Model']" ***!
  \*****************************************************/
/***/ ((module) => {

"use strict";
module.exports = flarum.core.compat['common/Model'];

/***/ }),

/***/ "flarum/common/app":
/*!***************************************************!*\
  !*** external "flarum.core.compat['common/app']" ***!
  \***************************************************/
/***/ ((module) => {

"use strict";
module.exports = flarum.core.compat['common/app'];

/***/ }),

/***/ "flarum/common/components/Button":
/*!*****************************************************************!*\
  !*** external "flarum.core.compat['common/components/Button']" ***!
  \*****************************************************************/
/***/ ((module) => {

"use strict";
module.exports = flarum.core.compat['common/components/Button'];

/***/ }),

/***/ "flarum/common/components/LinkButton":
/*!*********************************************************************!*\
  !*** external "flarum.core.compat['common/components/LinkButton']" ***!
  \*********************************************************************/
/***/ ((module) => {

"use strict";
module.exports = flarum.core.compat['common/components/LinkButton'];

/***/ }),

/***/ "flarum/common/components/LoadingIndicator":
/*!***************************************************************************!*\
  !*** external "flarum.core.compat['common/components/LoadingIndicator']" ***!
  \***************************************************************************/
/***/ ((module) => {

"use strict";
module.exports = flarum.core.compat['common/components/LoadingIndicator'];

/***/ }),

/***/ "flarum/common/components/Modal":
/*!****************************************************************!*\
  !*** external "flarum.core.compat['common/components/Modal']" ***!
  \****************************************************************/
/***/ ((module) => {

"use strict";
module.exports = flarum.core.compat['common/components/Modal'];

/***/ }),

/***/ "flarum/common/components/Tooltip":
/*!******************************************************************!*\
  !*** external "flarum.core.compat['common/components/Tooltip']" ***!
  \******************************************************************/
/***/ ((module) => {

"use strict";
module.exports = flarum.core.compat['common/components/Tooltip'];

/***/ }),

/***/ "flarum/common/extend":
/*!******************************************************!*\
  !*** external "flarum.core.compat['common/extend']" ***!
  \******************************************************/
/***/ ((module) => {

"use strict";
module.exports = flarum.core.compat['common/extend'];

/***/ }),

/***/ "flarum/common/extenders":
/*!*********************************************************!*\
  !*** external "flarum.core.compat['common/extenders']" ***!
  \*********************************************************/
/***/ ((module) => {

"use strict";
module.exports = flarum.core.compat['common/extenders'];

/***/ }),

/***/ "flarum/common/helpers/avatar":
/*!**************************************************************!*\
  !*** external "flarum.core.compat['common/helpers/avatar']" ***!
  \**************************************************************/
/***/ ((module) => {

"use strict";
module.exports = flarum.core.compat['common/helpers/avatar'];

/***/ }),

/***/ "flarum/common/helpers/icon":
/*!************************************************************!*\
  !*** external "flarum.core.compat['common/helpers/icon']" ***!
  \************************************************************/
/***/ ((module) => {

"use strict";
module.exports = flarum.core.compat['common/helpers/icon'];

/***/ }),

/***/ "flarum/common/helpers/username":
/*!****************************************************************!*\
  !*** external "flarum.core.compat['common/helpers/username']" ***!
  \****************************************************************/
/***/ ((module) => {

"use strict";
module.exports = flarum.core.compat['common/helpers/username'];

/***/ }),

/***/ "flarum/common/models/User":
/*!***********************************************************!*\
  !*** external "flarum.core.compat['common/models/User']" ***!
  \***********************************************************/
/***/ ((module) => {

"use strict";
module.exports = flarum.core.compat['common/models/User'];

/***/ }),

/***/ "flarum/common/utils/ItemList":
/*!**************************************************************!*\
  !*** external "flarum.core.compat['common/utils/ItemList']" ***!
  \**************************************************************/
/***/ ((module) => {

"use strict";
module.exports = flarum.core.compat['common/utils/ItemList'];

/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/esm/inheritsLoose.js":
/*!******************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/esm/inheritsLoose.js ***!
  \******************************************************************/
/***/ ((__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ _inheritsLoose)
/* harmony export */ });
/* harmony import */ var _setPrototypeOf_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./setPrototypeOf.js */ "./node_modules/@babel/runtime/helpers/esm/setPrototypeOf.js");

function _inheritsLoose(t, o) {
  t.prototype = Object.create(o.prototype), t.prototype.constructor = t, (0,_setPrototypeOf_js__WEBPACK_IMPORTED_MODULE_0__["default"])(t, o);
}


/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/esm/setPrototypeOf.js":
/*!*******************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/esm/setPrototypeOf.js ***!
  \*******************************************************************/
/***/ ((__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ _setPrototypeOf)
/* harmony export */ });
function _setPrototypeOf(t, e) {
  return _setPrototypeOf = Object.setPrototypeOf ? Object.setPrototypeOf.bind() : function (t, e) {
    return t.__proto__ = e, t;
  }, _setPrototypeOf(t, e);
}


/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/compat get default export */
/******/ 	(() => {
/******/ 		// getDefaultExport function for compatibility with non-harmony modules
/******/ 		__webpack_require__.n = (module) => {
/******/ 			var getter = module && module.__esModule ?
/******/ 				() => (module['default']) :
/******/ 				() => (module);
/******/ 			__webpack_require__.d(getter, { a: getter });
/******/ 			return getter;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry needs to be wrapped in an IIFE because it needs to be in strict mode.
(() => {
"use strict";
/*!******************!*\
  !*** ./admin.ts ***!
  \******************/
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   extend: () => (/* reexport safe */ _src_admin__WEBPACK_IMPORTED_MODULE_0__.extend)
/* harmony export */ });
/* harmony import */ var _src_admin__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./src/admin */ "./src/admin/index.tsx");

})();

module.exports = __webpack_exports__;
/******/ })()
;
//# sourceMappingURL=admin.js.map