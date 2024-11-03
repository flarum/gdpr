/******/ (() => { // webpackBootstrap
/******/ 	// runtime can't be in strict mode because a global variable is assign and maybe created.
/******/ 	var __webpack_modules__ = ({

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

/***/ "./src/forum/addAnonymousBadges.tsx":
/*!******************************************!*\
  !*** ./src/forum/addAnonymousBadges.tsx ***!
  \******************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* export default binding */ __WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var flarum_forum_app__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! flarum/forum/app */ "flarum/forum/app");
/* harmony import */ var flarum_forum_app__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(flarum_forum_app__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var flarum_common_extend__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! flarum/common/extend */ "flarum/common/extend");
/* harmony import */ var flarum_common_extend__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(flarum_common_extend__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var flarum_common_models_User__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! flarum/common/models/User */ "flarum/common/models/User");
/* harmony import */ var flarum_common_models_User__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(flarum_common_models_User__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var flarum_common_components_Badge__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! flarum/common/components/Badge */ "flarum/common/components/Badge");
/* harmony import */ var flarum_common_components_Badge__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(flarum_common_components_Badge__WEBPACK_IMPORTED_MODULE_3__);




/* harmony default export */ function __WEBPACK_DEFAULT_EXPORT__() {
  (0,flarum_common_extend__WEBPACK_IMPORTED_MODULE_1__.extend)((flarum_common_models_User__WEBPACK_IMPORTED_MODULE_2___default().prototype), 'badges', function (badges) {
    if (this.anonymized()) {
      badges.add('anonymized', m((flarum_common_components_Badge__WEBPACK_IMPORTED_MODULE_3___default()), {
        label: flarum_forum_app__WEBPACK_IMPORTED_MODULE_0___default().translator.trans('blomstra-gdpr.forum.badges.anonymized_user'),
        icon: "fas fa-user-secret",
        type: "anonymized"
      }));
    }
  });
}

/***/ }),

/***/ "./src/forum/components/DeleteUserModal.tsx":
/*!**************************************************!*\
  !*** ./src/forum/components/DeleteUserModal.tsx ***!
  \**************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ DeleteUserModal)
/* harmony export */ });
/* harmony import */ var _babel_runtime_helpers_esm_inheritsLoose__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/helpers/esm/inheritsLoose */ "./node_modules/@babel/runtime/helpers/esm/inheritsLoose.js");
/* harmony import */ var flarum_forum_app__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! flarum/forum/app */ "flarum/forum/app");
/* harmony import */ var flarum_forum_app__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(flarum_forum_app__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var flarum_common_components_Modal__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! flarum/common/components/Modal */ "flarum/common/components/Modal");
/* harmony import */ var flarum_common_components_Modal__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(flarum_common_components_Modal__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var flarum_common_helpers_username__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! flarum/common/helpers/username */ "flarum/common/helpers/username");
/* harmony import */ var flarum_common_helpers_username__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(flarum_common_helpers_username__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var flarum_common_components_Button__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! flarum/common/components/Button */ "flarum/common/components/Button");
/* harmony import */ var flarum_common_components_Button__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(flarum_common_components_Button__WEBPACK_IMPORTED_MODULE_4__);





var DeleteUserModal = /*#__PURE__*/function (_Modal) {
  function DeleteUserModal() {
    var _this;
    for (var _len = arguments.length, args = new Array(_len), _key = 0; _key < _len; _key++) {
      args[_key] = arguments[_key];
    }
    _this = _Modal.call.apply(_Modal, [this].concat(args)) || this;
    _this.user = void 0;
    _this.loadingAnonymization = false;
    _this.loadingDeletion = false;
    return _this;
  }
  (0,_babel_runtime_helpers_esm_inheritsLoose__WEBPACK_IMPORTED_MODULE_0__["default"])(DeleteUserModal, _Modal);
  var _proto = DeleteUserModal.prototype;
  _proto.oninit = function oninit(vnode) {
    _Modal.prototype.oninit.call(this, vnode);
    this.user = this.attrs.user;
  };
  _proto.className = function className() {
    return 'DeleteUserModal Modal--small';
  };
  _proto.title = function title() {
    return flarum_forum_app__WEBPACK_IMPORTED_MODULE_1___default().translator.trans('blomstra-gdpr.forum.delete_user.title', {
      username: flarum_common_helpers_username__WEBPACK_IMPORTED_MODULE_3___default()(this.user)
    });
  };
  _proto.content = function content() {
    var _this2 = this;
    return m("div", {
      className: "Modal-body"
    }, m("div", {
      className: "Form Form--centered"
    }, m("p", {
      className: "helpText"
    }, flarum_forum_app__WEBPACK_IMPORTED_MODULE_1___default().translator.trans('blomstra-gdpr.forum.delete_user.text', {
      username: flarum_common_helpers_username__WEBPACK_IMPORTED_MODULE_3___default()(this.user)
    })), m("div", {
      className: "Form-group"
    }, m((flarum_common_components_Button__WEBPACK_IMPORTED_MODULE_4___default()), {
      className: "Button Button--primary Button--block",
      onclick: function onclick() {
        return _this2.defaultErasure();
      },
      loading: this.loading,
      disabled: this.loading
    }, flarum_forum_app__WEBPACK_IMPORTED_MODULE_1___default().translator.trans('blomstra-gdpr.forum.delete_user.modal_delete_button'))), flarum_forum_app__WEBPACK_IMPORTED_MODULE_1___default().forum.attribute('erasureAnonymizationAllowed') && flarum_forum_app__WEBPACK_IMPORTED_MODULE_1___default().forum.attribute('erasureDeletionAllowed') && m("div", null, m("div", {
      className: "Form-group"
    }, m((flarum_common_components_Button__WEBPACK_IMPORTED_MODULE_4___default()), {
      className: "Button Button--block",
      onclick: function onclick() {
        return _this2.specificErasure('anonymization');
      },
      loading: this.loadingAnonymization,
      disabled: this.loadingAnonymization
    }, flarum_forum_app__WEBPACK_IMPORTED_MODULE_1___default().translator.trans('blomstra-gdpr.forum.process_erasure.anonymization_button'))), m("div", {
      className: "Form-group"
    }, m((flarum_common_components_Button__WEBPACK_IMPORTED_MODULE_4___default()), {
      className: "Button Button--danger Button--block",
      onclick: function onclick() {
        return _this2.specificErasure('deletion');
      },
      loading: this.loadingDeletion,
      disabled: this.loadingDeletion
    }, flarum_forum_app__WEBPACK_IMPORTED_MODULE_1___default().translator.trans('blomstra-gdpr.forum.process_erasure.deletion_button'))))));
  };
  _proto.defaultErasure = function defaultErasure() {
    var _this3 = this;
    this.loading = true;
    this.user["delete"]().then(function () {
      _this3.hide();
      _this3.loading = false;
      m.redraw();
    }, function () {});
  };
  _proto.specificErasure = function specificErasure(mode) {
    var _this4 = this;
    if (mode === 'anonymization') {
      this.loadingAnonymization = true;
    } else {
      this.loadingDeletion = true;
    }
    flarum_forum_app__WEBPACK_IMPORTED_MODULE_1___default().request({
      method: 'DELETE',
      url: flarum_forum_app__WEBPACK_IMPORTED_MODULE_1___default().forum.attribute('apiUrl') + '/users/' + this.user.id() + '/gdpr/' + mode
    }).then(function () {
      _this4.hide();
      _this4.loadingAnonymization = false;
      _this4.loadingDeletion = false;
      m.redraw();
    }, function () {
      return [];
    });
  };
  return DeleteUserModal;
}((flarum_common_components_Modal__WEBPACK_IMPORTED_MODULE_2___default()));


/***/ }),

/***/ "./src/forum/components/ErasureRequestsDropdown.tsx":
/*!**********************************************************!*\
  !*** ./src/forum/components/ErasureRequestsDropdown.tsx ***!
  \**********************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ ErasureRequestsDropdown)
/* harmony export */ });
/* harmony import */ var _babel_runtime_helpers_esm_inheritsLoose__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/helpers/esm/inheritsLoose */ "./node_modules/@babel/runtime/helpers/esm/inheritsLoose.js");
/* harmony import */ var flarum_forum_app__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! flarum/forum/app */ "flarum/forum/app");
/* harmony import */ var flarum_forum_app__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(flarum_forum_app__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var flarum_forum_components_NotificationsDropdown__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! flarum/forum/components/NotificationsDropdown */ "flarum/forum/components/NotificationsDropdown");
/* harmony import */ var flarum_forum_components_NotificationsDropdown__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(flarum_forum_components_NotificationsDropdown__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _ErasureRequestsList__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./ErasureRequestsList */ "./src/forum/components/ErasureRequestsList.js");




var ErasureRequestsDropdown = /*#__PURE__*/function (_NotificationsDropdow) {
  function ErasureRequestsDropdown() {
    return _NotificationsDropdow.apply(this, arguments) || this;
  }
  (0,_babel_runtime_helpers_esm_inheritsLoose__WEBPACK_IMPORTED_MODULE_0__["default"])(ErasureRequestsDropdown, _NotificationsDropdow);
  ErasureRequestsDropdown.initAttrs = function initAttrs(attrs) {
    attrs.label = attrs.label || flarum_forum_app__WEBPACK_IMPORTED_MODULE_1___default().translator.trans('blomstra-gdpr.forum.erasure_requests.tooltip');
    attrs.icon = attrs.icon || 'fas fa-user-minus';
    _NotificationsDropdow.initAttrs.call(this, attrs);
  };
  var _proto = ErasureRequestsDropdown.prototype;
  _proto.getMenu = function getMenu() {
    return m("div", {
      className: 'Dropdown-menu ' + this.attrs.menuClassName,
      onclick: this.menuClick.bind(this)
    }, this.showing ? _ErasureRequestsList__WEBPACK_IMPORTED_MODULE_3__["default"].component({
      state: this.attrs.state
    }) : '');
  };
  _proto.goToRoute = function goToRoute() {
    m.route.set(flarum_forum_app__WEBPACK_IMPORTED_MODULE_1___default().route('erasure-requests'));
  };
  _proto.getUnreadCount = function getUnreadCount() {
    if (!this.attrs.state.requestsLoaded) {
      return flarum_forum_app__WEBPACK_IMPORTED_MODULE_1___default().forum.attribute('erasureRequestCount');
    }
    return flarum_forum_app__WEBPACK_IMPORTED_MODULE_1___default().store.all('erasure-requests').length;
  };
  _proto.getNewCount = function getNewCount() {
    return this.getUnreadCount();
  };
  return ErasureRequestsDropdown;
}((flarum_forum_components_NotificationsDropdown__WEBPACK_IMPORTED_MODULE_2___default()));


/***/ }),

/***/ "./src/forum/components/ErasureRequestsList.js":
/*!*****************************************************!*\
  !*** ./src/forum/components/ErasureRequestsList.js ***!
  \*****************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ ErasureRequestsList)
/* harmony export */ });
/* harmony import */ var _babel_runtime_helpers_esm_inheritsLoose__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/helpers/esm/inheritsLoose */ "./node_modules/@babel/runtime/helpers/esm/inheritsLoose.js");
/* harmony import */ var flarum_forum_app__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! flarum/forum/app */ "flarum/forum/app");
/* harmony import */ var flarum_forum_app__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(flarum_forum_app__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var flarum_common_Component__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! flarum/common/Component */ "flarum/common/Component");
/* harmony import */ var flarum_common_Component__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(flarum_common_Component__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var flarum_common_components_LoadingIndicator__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! flarum/common/components/LoadingIndicator */ "flarum/common/components/LoadingIndicator");
/* harmony import */ var flarum_common_components_LoadingIndicator__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(flarum_common_components_LoadingIndicator__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var flarum_common_helpers_avatar__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! flarum/common/helpers/avatar */ "flarum/common/helpers/avatar");
/* harmony import */ var flarum_common_helpers_avatar__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(flarum_common_helpers_avatar__WEBPACK_IMPORTED_MODULE_4__);
/* harmony import */ var flarum_common_helpers_icon__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! flarum/common/helpers/icon */ "flarum/common/helpers/icon");
/* harmony import */ var flarum_common_helpers_icon__WEBPACK_IMPORTED_MODULE_5___default = /*#__PURE__*/__webpack_require__.n(flarum_common_helpers_icon__WEBPACK_IMPORTED_MODULE_5__);
/* harmony import */ var flarum_common_helpers_username__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! flarum/common/helpers/username */ "flarum/common/helpers/username");
/* harmony import */ var flarum_common_helpers_username__WEBPACK_IMPORTED_MODULE_6___default = /*#__PURE__*/__webpack_require__.n(flarum_common_helpers_username__WEBPACK_IMPORTED_MODULE_6__);
/* harmony import */ var flarum_common_helpers_humanTime__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! flarum/common/helpers/humanTime */ "flarum/common/helpers/humanTime");
/* harmony import */ var flarum_common_helpers_humanTime__WEBPACK_IMPORTED_MODULE_7___default = /*#__PURE__*/__webpack_require__.n(flarum_common_helpers_humanTime__WEBPACK_IMPORTED_MODULE_7__);
/* harmony import */ var _ProcessErasureRequestModal__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! ./ProcessErasureRequestModal */ "./src/forum/components/ProcessErasureRequestModal.tsx");









var ErasureRequestsList = /*#__PURE__*/function (_Component) {
  function ErasureRequestsList() {
    return _Component.apply(this, arguments) || this;
  }
  (0,_babel_runtime_helpers_esm_inheritsLoose__WEBPACK_IMPORTED_MODULE_0__["default"])(ErasureRequestsList, _Component);
  var _proto = ErasureRequestsList.prototype;
  _proto.view = function view() {
    var _this = this;
    var erasureRequests = flarum_forum_app__WEBPACK_IMPORTED_MODULE_1___default().store.all('user-erasure-requests');
    var state = this.attrs.state;
    return m("div", {
      className: "NotificationList ErasureRequestsList"
    }, m("div", {
      className: "NotificationList-header"
    }, m("h4", {
      className: "App-titleControl App-titleControl--text"
    }, flarum_forum_app__WEBPACK_IMPORTED_MODULE_1___default().translator.trans('blomstra-gdpr.forum.erasure_requests.title'))), m("div", {
      className: "NotificationList-content"
    }, m("ul", {
      className: "NotificationGroup-content"
    }, erasureRequests.length ? erasureRequests.map(function (request) {
      return m("li", null, m("a", {
        onclick: _this.showModal.bind(_this, request),
        className: "Notification Request"
      }, flarum_common_helpers_avatar__WEBPACK_IMPORTED_MODULE_4___default()(request.user()), flarum_common_helpers_icon__WEBPACK_IMPORTED_MODULE_5___default()('fas fa-user-edit', {
        className: 'Notification-icon'
      }), m("span", {
        className: "Notification-content"
      }, flarum_forum_app__WEBPACK_IMPORTED_MODULE_1___default().translator.trans("blomstra-gdpr.forum.erasure_requests.item_text", {
        name: flarum_common_helpers_username__WEBPACK_IMPORTED_MODULE_6___default()(request.user())
      })), flarum_common_helpers_humanTime__WEBPACK_IMPORTED_MODULE_7___default()(request.createdAt())));
    }) : !state.loading ? m("div", {
      className: "NotificationList-empty"
    }, flarum_forum_app__WEBPACK_IMPORTED_MODULE_1___default().translator.trans('blomstra-gdpr.forum.erasure_requests.empty_text')) : flarum_common_components_LoadingIndicator__WEBPACK_IMPORTED_MODULE_3___default().component({
      className: 'LoadingIndicator--block'
    }))));
  };
  _proto.showModal = function showModal(request) {
    flarum_forum_app__WEBPACK_IMPORTED_MODULE_1___default().modal.show(_ProcessErasureRequestModal__WEBPACK_IMPORTED_MODULE_8__["default"], {
      request: request
    });
  };
  return ErasureRequestsList;
}((flarum_common_Component__WEBPACK_IMPORTED_MODULE_2___default()));


/***/ }),

/***/ "./src/forum/components/ErasureRequestsPage.js":
/*!*****************************************************!*\
  !*** ./src/forum/components/ErasureRequestsPage.js ***!
  \*****************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ ErasureRequestsPage)
/* harmony export */ });
/* harmony import */ var _babel_runtime_helpers_esm_inheritsLoose__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/helpers/esm/inheritsLoose */ "./node_modules/@babel/runtime/helpers/esm/inheritsLoose.js");
/* harmony import */ var flarum_forum_app__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! flarum/forum/app */ "flarum/forum/app");
/* harmony import */ var flarum_forum_app__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(flarum_forum_app__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var flarum_common_components_Page__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! flarum/common/components/Page */ "flarum/common/components/Page");
/* harmony import */ var flarum_common_components_Page__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(flarum_common_components_Page__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _ErasureRequestsList__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./ErasureRequestsList */ "./src/forum/components/ErasureRequestsList.js");




var ErasureRequestsPage = /*#__PURE__*/function (_Page) {
  function ErasureRequestsPage() {
    return _Page.apply(this, arguments) || this;
  }
  (0,_babel_runtime_helpers_esm_inheritsLoose__WEBPACK_IMPORTED_MODULE_0__["default"])(ErasureRequestsPage, _Page);
  var _proto = ErasureRequestsPage.prototype;
  _proto.oninit = function oninit(vnode) {
    _Page.prototype.oninit.call(this, vnode);
    flarum_forum_app__WEBPACK_IMPORTED_MODULE_1___default().history.push('erasure-requests');
    flarum_forum_app__WEBPACK_IMPORTED_MODULE_1___default().erasureRequests.load();
    this.bodyClass = 'App--ErasureRequests';
  };
  _proto.view = function view() {
    return m("div", {
      className: "ErasureRequestsPage"
    }, m(_ErasureRequestsList__WEBPACK_IMPORTED_MODULE_3__["default"], {
      state: (flarum_forum_app__WEBPACK_IMPORTED_MODULE_1___default().erasureRequests)
    }));
  };
  return ErasureRequestsPage;
}((flarum_common_components_Page__WEBPACK_IMPORTED_MODULE_2___default()));


/***/ }),

/***/ "./src/forum/components/ExportAvailableNotification.ts":
/*!*************************************************************!*\
  !*** ./src/forum/components/ExportAvailableNotification.ts ***!
  \*************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ ExportAvailableNotification)
/* harmony export */ });
/* harmony import */ var _babel_runtime_helpers_esm_inheritsLoose__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/helpers/esm/inheritsLoose */ "./node_modules/@babel/runtime/helpers/esm/inheritsLoose.js");
/* harmony import */ var flarum_forum_app__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! flarum/forum/app */ "flarum/forum/app");
/* harmony import */ var flarum_forum_app__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(flarum_forum_app__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var flarum_forum_components_Notification__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! flarum/forum/components/Notification */ "flarum/forum/components/Notification");
/* harmony import */ var flarum_forum_components_Notification__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(flarum_forum_components_Notification__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var flarum_common_helpers_username__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! flarum/common/helpers/username */ "flarum/common/helpers/username");
/* harmony import */ var flarum_common_helpers_username__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(flarum_common_helpers_username__WEBPACK_IMPORTED_MODULE_3__);




var ExportAvailableNotification = /*#__PURE__*/function (_Notification) {
  function ExportAvailableNotification() {
    return _Notification.apply(this, arguments) || this;
  }
  (0,_babel_runtime_helpers_esm_inheritsLoose__WEBPACK_IMPORTED_MODULE_0__["default"])(ExportAvailableNotification, _Notification);
  var _proto = ExportAvailableNotification.prototype;
  _proto.icon = function icon() {
    return 'fas fa-file-export';
  };
  _proto.href = function href() {
    var exportModel = this.attrs.notification.subject();

    // Building the full url scheme so that Mithril treats this as an external link, so the download will work correctly.
    return flarum_forum_app__WEBPACK_IMPORTED_MODULE_1___default().forum.attribute('baseUrl') + ("/gdpr/export/" + exportModel.file());
  };
  _proto.content = function content() {
    var notification = this.attrs.notification;
    return flarum_forum_app__WEBPACK_IMPORTED_MODULE_1___default().translator.trans('blomstra-gdpr.forum.notification.export-ready', {
      username: flarum_common_helpers_username__WEBPACK_IMPORTED_MODULE_3___default()(notification.fromUser())
    });
  };
  _proto.excerpt = function excerpt() {
    return null;
  };
  return ExportAvailableNotification;
}((flarum_forum_components_Notification__WEBPACK_IMPORTED_MODULE_2___default()));


/***/ }),

/***/ "./src/forum/components/ProcessErasureRequestModal.tsx":
/*!*************************************************************!*\
  !*** ./src/forum/components/ProcessErasureRequestModal.tsx ***!
  \*************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ ProcessErasureRequestModal)
/* harmony export */ });
/* harmony import */ var _babel_runtime_helpers_esm_inheritsLoose__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/helpers/esm/inheritsLoose */ "./node_modules/@babel/runtime/helpers/esm/inheritsLoose.js");
/* harmony import */ var flarum_forum_app__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! flarum/forum/app */ "flarum/forum/app");
/* harmony import */ var flarum_forum_app__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(flarum_forum_app__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var flarum_common_components_Modal__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! flarum/common/components/Modal */ "flarum/common/components/Modal");
/* harmony import */ var flarum_common_components_Modal__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(flarum_common_components_Modal__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var flarum_common_components_Button__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! flarum/common/components/Button */ "flarum/common/components/Button");
/* harmony import */ var flarum_common_components_Button__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(flarum_common_components_Button__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var flarum_common_helpers_username__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! flarum/common/helpers/username */ "flarum/common/helpers/username");
/* harmony import */ var flarum_common_helpers_username__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(flarum_common_helpers_username__WEBPACK_IMPORTED_MODULE_4__);
/* harmony import */ var flarum_common_utils_extractText__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! flarum/common/utils/extractText */ "flarum/common/utils/extractText");
/* harmony import */ var flarum_common_utils_extractText__WEBPACK_IMPORTED_MODULE_5___default = /*#__PURE__*/__webpack_require__.n(flarum_common_utils_extractText__WEBPACK_IMPORTED_MODULE_5__);
/* harmony import */ var flarum_common_utils_ItemList__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! flarum/common/utils/ItemList */ "flarum/common/utils/ItemList");
/* harmony import */ var flarum_common_utils_ItemList__WEBPACK_IMPORTED_MODULE_6___default = /*#__PURE__*/__webpack_require__.n(flarum_common_utils_ItemList__WEBPACK_IMPORTED_MODULE_6__);
/* harmony import */ var flarum_common_utils_Stream__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! flarum/common/utils/Stream */ "flarum/common/utils/Stream");
/* harmony import */ var flarum_common_utils_Stream__WEBPACK_IMPORTED_MODULE_7___default = /*#__PURE__*/__webpack_require__.n(flarum_common_utils_Stream__WEBPACK_IMPORTED_MODULE_7__);
/* harmony import */ var flarum_forum_components_UserCard__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! flarum/forum/components/UserCard */ "flarum/forum/components/UserCard");
/* harmony import */ var flarum_forum_components_UserCard__WEBPACK_IMPORTED_MODULE_8___default = /*#__PURE__*/__webpack_require__.n(flarum_forum_components_UserCard__WEBPACK_IMPORTED_MODULE_8__);









var ProcessErasureRequestModal = /*#__PURE__*/function (_Modal) {
  function ProcessErasureRequestModal() {
    var _this;
    for (var _len = arguments.length, args = new Array(_len), _key = 0; _key < _len; _key++) {
      args[_key] = arguments[_key];
    }
    _this = _Modal.call.apply(_Modal, [this].concat(args)) || this;
    _this.comments = void 0;
    _this.loadingAnonymization = false;
    _this.loadingDeletion = false;
    _this.request = void 0;
    return _this;
  }
  (0,_babel_runtime_helpers_esm_inheritsLoose__WEBPACK_IMPORTED_MODULE_0__["default"])(ProcessErasureRequestModal, _Modal);
  var _proto = ProcessErasureRequestModal.prototype;
  _proto.oninit = function oninit(vnode) {
    _Modal.prototype.oninit.call(this, vnode);
    this.request = this.attrs.request;
    this.comments = flarum_common_utils_Stream__WEBPACK_IMPORTED_MODULE_7___default()('');
  };
  _proto.className = function className() {
    return 'ProcessErasureRequestModal Modal--medium';
  };
  _proto.title = function title() {
    return flarum_forum_app__WEBPACK_IMPORTED_MODULE_1___default().translator.trans('blomstra-gdpr.forum.process_erasure.title');
  };
  _proto.content = function content() {
    return m("div", {
      className: "Modal-body"
    }, m("div", {
      className: "Form Form--centered"
    }, this.fields().toArray()));
  };
  _proto.fields = function fields() {
    var _this2 = this;
    var items = new (flarum_common_utils_ItemList__WEBPACK_IMPORTED_MODULE_6___default())();
    var erasureRequest = this.attrs.request;
    items.add('text', m("div", null, m((flarum_forum_components_UserCard__WEBPACK_IMPORTED_MODULE_8___default()), {
      className: "UserCard--popover UserCard--gdpr",
      user: this.request.user()
    }), m("p", {
      className: "helpText"
    }, flarum_forum_app__WEBPACK_IMPORTED_MODULE_1___default().translator.trans('blomstra-gdpr.forum.process_erasure.text', {
      name: flarum_common_helpers_username__WEBPACK_IMPORTED_MODULE_4___default()(this.request.user())
    }))));
    (erasureRequest == null ? void 0 : erasureRequest.reason()) && items.add('reason', m("p", {
      className: "helpText"
    }, m("code", null, erasureRequest.reason())));
    items.add('comments', m("div", {
      className: "Form-group"
    }, m("textarea", {
      className: "FormControl",
      value: this.comments(),
      bidi: this.comments,
      placeholder: flarum_common_utils_extractText__WEBPACK_IMPORTED_MODULE_5___default()(flarum_forum_app__WEBPACK_IMPORTED_MODULE_1___default().translator.trans('blomstra-gdpr.forum.process_erasure.comments_label'))
    })));
    if (flarum_forum_app__WEBPACK_IMPORTED_MODULE_1___default().forum.attribute('erasureAnonymizationAllowed')) {
      items.add('anonymize', m("div", {
        className: "Form-group"
      }, flarum_common_components_Button__WEBPACK_IMPORTED_MODULE_3___default().component({
        className: 'Button Button--primary Button--block',
        loading: this.loadingAnonymization,
        onclick: function onclick() {
          return _this2.process('anonymization');
        }
      }, flarum_forum_app__WEBPACK_IMPORTED_MODULE_1___default().translator.trans('blomstra-gdpr.forum.process_erasure.anonymization_button'))));
    }
    if (flarum_forum_app__WEBPACK_IMPORTED_MODULE_1___default().forum.attribute('erasureDeletionAllowed')) {
      items.add('delete', m("div", {
        className: "Form-group"
      }, flarum_common_components_Button__WEBPACK_IMPORTED_MODULE_3___default().component({
        className: 'Button Button--danger Button--block',
        loading: this.loadingDeletion,
        onclick: function onclick() {
          return _this2.process('deletion');
        }
      }, flarum_forum_app__WEBPACK_IMPORTED_MODULE_1___default().translator.trans('blomstra-gdpr.forum.process_erasure.deletion_button'))));
    }
    return items;
  };
  _proto.process = function process(mode) {
    var _this3 = this;
    if (!confirm(flarum_forum_app__WEBPACK_IMPORTED_MODULE_1___default().translator.trans('blomstra-gdpr.forum.process_erasure.confirm', {
      name: flarum_common_utils_extractText__WEBPACK_IMPORTED_MODULE_5___default()(flarum_common_helpers_username__WEBPACK_IMPORTED_MODULE_4___default()(this.request.user())),
      mode: mode
    }))) {
      return;
    }
    if (mode === 'anonymization') {
      this.loadingAnonymization = true;
    } else {
      this.loadingDeletion = true;
    }
    m.redraw();
    this.request.save({
      processor_comment: this.comments(),
      meta: {
        mode: mode
      }
    }).then(function (erasureRequest) {
      flarum_forum_app__WEBPACK_IMPORTED_MODULE_1___default().store.remove(erasureRequest);
      _this3.loadingAnonymization = false;
      _this3.loadingDeletion = false;
      m.redraw();
      _this3.hide();
    })["catch"](function () {
      _this3.loadingAnonymization = false;
      _this3.loadingDeletion = false;
      m.redraw();
    });
  };
  return ProcessErasureRequestModal;
}((flarum_common_components_Modal__WEBPACK_IMPORTED_MODULE_2___default()));


/***/ }),

/***/ "./src/forum/components/RequestErasureModal.js":
/*!*****************************************************!*\
  !*** ./src/forum/components/RequestErasureModal.js ***!
  \*****************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ RequestErasureModal)
/* harmony export */ });
/* harmony import */ var _babel_runtime_helpers_esm_inheritsLoose__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/helpers/esm/inheritsLoose */ "./node_modules/@babel/runtime/helpers/esm/inheritsLoose.js");
/* harmony import */ var flarum_forum_app__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! flarum/forum/app */ "flarum/forum/app");
/* harmony import */ var flarum_forum_app__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(flarum_forum_app__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var flarum_common_components_Modal__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! flarum/common/components/Modal */ "flarum/common/components/Modal");
/* harmony import */ var flarum_common_components_Modal__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(flarum_common_components_Modal__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var flarum_common_components_Button__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! flarum/common/components/Button */ "flarum/common/components/Button");
/* harmony import */ var flarum_common_components_Button__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(flarum_common_components_Button__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var flarum_common_utils_extractText__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! flarum/common/utils/extractText */ "flarum/common/utils/extractText");
/* harmony import */ var flarum_common_utils_extractText__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(flarum_common_utils_extractText__WEBPACK_IMPORTED_MODULE_4__);
/* harmony import */ var flarum_common_utils_ItemList__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! flarum/common/utils/ItemList */ "flarum/common/utils/ItemList");
/* harmony import */ var flarum_common_utils_ItemList__WEBPACK_IMPORTED_MODULE_5___default = /*#__PURE__*/__webpack_require__.n(flarum_common_utils_ItemList__WEBPACK_IMPORTED_MODULE_5__);
/* harmony import */ var flarum_common_utils_Stream__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! flarum/common/utils/Stream */ "flarum/common/utils/Stream");
/* harmony import */ var flarum_common_utils_Stream__WEBPACK_IMPORTED_MODULE_6___default = /*#__PURE__*/__webpack_require__.n(flarum_common_utils_Stream__WEBPACK_IMPORTED_MODULE_6__);







var RequestErasureModal = /*#__PURE__*/function (_Modal) {
  function RequestErasureModal() {
    return _Modal.apply(this, arguments) || this;
  }
  (0,_babel_runtime_helpers_esm_inheritsLoose__WEBPACK_IMPORTED_MODULE_0__["default"])(RequestErasureModal, _Modal);
  var _proto = RequestErasureModal.prototype;
  _proto.oninit = function oninit(vnode) {
    _Modal.prototype.oninit.call(this, vnode);
    this.reason = flarum_common_utils_Stream__WEBPACK_IMPORTED_MODULE_6___default()('');
    this.password = flarum_common_utils_Stream__WEBPACK_IMPORTED_MODULE_6___default()('');
  };
  _proto.className = function className() {
    return 'RequestErasureModal Modal--small';
  };
  _proto.title = function title() {
    return flarum_forum_app__WEBPACK_IMPORTED_MODULE_1___default().translator.trans('blomstra-gdpr.forum.request_erasure.title');
  };
  _proto.content = function content() {
    return m("div", {
      className: "Modal-body"
    }, m("div", {
      className: "Form Form--centered"
    }, this.fields().toArray()));
  };
  _proto.fields = function fields() {
    var _this = this;
    var items = new (flarum_common_utils_ItemList__WEBPACK_IMPORTED_MODULE_5___default())();
    var currRequest = flarum_forum_app__WEBPACK_IMPORTED_MODULE_1___default().session.user.erasureRequest();
    if (currRequest) {
      items.add('status', m("div", {
        className: "Form-group"
      }, m("p", {
        className: "helpText"
      }, flarum_forum_app__WEBPACK_IMPORTED_MODULE_1___default().translator.trans("blomstra-gdpr.forum.request_erasure.status." + currRequest.status()))));
      if (currRequest.reason()) {
        items.add('reason', m("div", {
          className: "Form-group"
        }, m("p", {
          className: "helpText"
        }, flarum_forum_app__WEBPACK_IMPORTED_MODULE_1___default().translator.trans('blomstra-gdpr.forum.request_erasure.reason', {
          reason: currRequest.reason()
        }))));
      }
      items.add('cancel', m("div", {
        className: "Form-group"
      }, flarum_common_components_Button__WEBPACK_IMPORTED_MODULE_3___default().component({
        className: 'Button Button--primary Button--block',
        onclick: this.oncancel.bind(this),
        loading: this.loading
      }, flarum_forum_app__WEBPACK_IMPORTED_MODULE_1___default().translator.trans('blomstra-gdpr.forum.request_erasure.cancel_button'))));
    } else {
      items.add('text', m("p", {
        className: "helpText"
      }, flarum_forum_app__WEBPACK_IMPORTED_MODULE_1___default().translator.trans('blomstra-gdpr.forum.request_erasure.text')));
      if (!flarum_forum_app__WEBPACK_IMPORTED_MODULE_1___default().forum.attribute('passwordlessSignUp')) {
        items.add('password', m("div", {
          className: "Form-group"
        }, m("input", {
          type: "password",
          className: "FormControl",
          bidi: this.password,
          placeholder: flarum_common_utils_extractText__WEBPACK_IMPORTED_MODULE_4___default()(flarum_forum_app__WEBPACK_IMPORTED_MODULE_1___default().translator.trans('blomstra-gdpr.forum.request_erasure.password_label'))
        })));
      }
      items.add('reason', m("div", {
        className: "Form-group"
      }, m("textarea", {
        className: "FormControl",
        value: this.reason(),
        oninput: function oninput(e) {
          return _this.reason(e.target.value);
        },
        placeholder: flarum_common_utils_extractText__WEBPACK_IMPORTED_MODULE_4___default()(flarum_forum_app__WEBPACK_IMPORTED_MODULE_1___default().translator.trans('blomstra-gdpr.forum.request_erasure.reason_label'))
      })));
      items.add('submit', m("div", {
        className: "Form-group"
      }, flarum_common_components_Button__WEBPACK_IMPORTED_MODULE_3___default().component({
        className: 'Button Button--primary Button--block',
        type: 'submit',
        loading: this.loading
      }, flarum_forum_app__WEBPACK_IMPORTED_MODULE_1___default().translator.trans('blomstra-gdpr.forum.request_erasure.request_button'))));
    }
    return items;
  };
  _proto.oncancel = function oncancel(e) {
    var _this2 = this;
    this.loading = true;
    m.redraw();
    flarum_forum_app__WEBPACK_IMPORTED_MODULE_1___default().session.user.erasureRequest()["delete"]().then(function () {
      _this2.loading = false;
      m.redraw();
    });
  };
  _proto.data = function data() {
    // Status is set so that the proper confirmation message is displayed.
    return {
      reason: this.reason(),
      status: 'user_confirmed',
      relationships: {
        user: (flarum_forum_app__WEBPACK_IMPORTED_MODULE_1___default().session).user
      }
    };
  };
  _proto.onsubmit = function onsubmit(e) {
    var _this3 = this;
    e.preventDefault();
    this.loading = true;
    flarum_forum_app__WEBPACK_IMPORTED_MODULE_1___default().store.createRecord('user-erasure-requests').save(this.data(), {
      meta: {
        password: this.password()
      }
    }).then(function (erasureRequest) {
      flarum_forum_app__WEBPACK_IMPORTED_MODULE_1___default().session.user.pushData({
        relationships: {
          erasureRequest: erasureRequest
        }
      });
      _this3.loading = false;
      m.redraw();
    })["catch"](function () {
      _this3.loading = false;
      m.redraw();
    });
  };
  return RequestErasureModal;
}((flarum_common_components_Modal__WEBPACK_IMPORTED_MODULE_2___default()));


/***/ }),

/***/ "./src/forum/extend.ts":
/*!*****************************!*\
  !*** ./src/forum/extend.ts ***!
  \*****************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var flarum_common_extenders__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! flarum/common/extenders */ "flarum/common/extenders");
/* harmony import */ var flarum_common_extenders__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(flarum_common_extenders__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _components_ErasureRequestsPage__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./components/ErasureRequestsPage */ "./src/forum/components/ErasureRequestsPage.js");
/* harmony import */ var _common_extend__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../common/extend */ "./src/common/extend.ts");



/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ([].concat(_common_extend__WEBPACK_IMPORTED_MODULE_2__["default"], [new (flarum_common_extenders__WEBPACK_IMPORTED_MODULE_0___default().Routes)() //
.add('erasure-requests', '/erasure-requests', _components_ErasureRequestsPage__WEBPACK_IMPORTED_MODULE_1__["default"])]));

/***/ }),

/***/ "./src/forum/extenders/extendHeaderSecondary.tsx":
/*!*******************************************************!*\
  !*** ./src/forum/extenders/extendHeaderSecondary.tsx ***!
  \*******************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ extendHeaderSecondary)
/* harmony export */ });
/* harmony import */ var flarum_forum_app__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! flarum/forum/app */ "flarum/forum/app");
/* harmony import */ var flarum_forum_app__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(flarum_forum_app__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var flarum_common_extend__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! flarum/common/extend */ "flarum/common/extend");
/* harmony import */ var flarum_common_extend__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(flarum_common_extend__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var flarum_forum_components_HeaderSecondary__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! flarum/forum/components/HeaderSecondary */ "flarum/forum/components/HeaderSecondary");
/* harmony import */ var flarum_forum_components_HeaderSecondary__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(flarum_forum_components_HeaderSecondary__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _components_ErasureRequestsDropdown__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../components/ErasureRequestsDropdown */ "./src/forum/components/ErasureRequestsDropdown.tsx");




function extendHeaderSecondary() {
  (0,flarum_common_extend__WEBPACK_IMPORTED_MODULE_1__.extend)((flarum_forum_components_HeaderSecondary__WEBPACK_IMPORTED_MODULE_2___default().prototype), 'items', function (items) {
    if (flarum_forum_app__WEBPACK_IMPORTED_MODULE_0___default().forum.attribute('erasureRequestCount')) {
      items.add('erasureRequests', m(_components_ErasureRequestsDropdown__WEBPACK_IMPORTED_MODULE_3__["default"], {
        state: (flarum_forum_app__WEBPACK_IMPORTED_MODULE_0___default().erasureRequests)
      }), 20);
    }
  });
}

/***/ }),

/***/ "./src/forum/extenders/extendPage.ts":
/*!*******************************************!*\
  !*** ./src/forum/extenders/extendPage.ts ***!
  \*******************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ extendPage)
/* harmony export */ });
/* harmony import */ var flarum_forum_app__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! flarum/forum/app */ "flarum/forum/app");
/* harmony import */ var flarum_forum_app__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(flarum_forum_app__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var flarum_common_extend__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! flarum/common/extend */ "flarum/common/extend");
/* harmony import */ var flarum_common_extend__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(flarum_common_extend__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var flarum_common_components_Page__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! flarum/common/components/Page */ "flarum/common/components/Page");
/* harmony import */ var flarum_common_components_Page__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(flarum_common_components_Page__WEBPACK_IMPORTED_MODULE_2__);



function extendPage() {
  (0,flarum_common_extend__WEBPACK_IMPORTED_MODULE_1__.extend)((flarum_common_components_Page__WEBPACK_IMPORTED_MODULE_2___default().prototype), 'oninit', function () {
    if (m.route.param('erasureRequestConfirmed')) {
      flarum_forum_app__WEBPACK_IMPORTED_MODULE_0___default().alerts.show({
        type: 'success'
      }, flarum_forum_app__WEBPACK_IMPORTED_MODULE_0___default().translator.trans('blomstra-gdpr.forum.erasure_request_confirmed'));
    }
  });
}

/***/ }),

/***/ "./src/forum/extenders/extendUserControls.tsx":
/*!****************************************************!*\
  !*** ./src/forum/extenders/extendUserControls.tsx ***!
  \****************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ extendUserControls)
/* harmony export */ });
/* harmony import */ var flarum_forum_app__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! flarum/forum/app */ "flarum/forum/app");
/* harmony import */ var flarum_forum_app__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(flarum_forum_app__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var flarum_common_extend__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! flarum/common/extend */ "flarum/common/extend");
/* harmony import */ var flarum_common_extend__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(flarum_common_extend__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var flarum_forum_utils_UserControls__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! flarum/forum/utils/UserControls */ "flarum/forum/utils/UserControls");
/* harmony import */ var flarum_forum_utils_UserControls__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(flarum_forum_utils_UserControls__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var flarum_common_components_Button__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! flarum/common/components/Button */ "flarum/common/components/Button");
/* harmony import */ var flarum_common_components_Button__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(flarum_common_components_Button__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var _common_components_RequestDataExportModal__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ../../common/components/RequestDataExportModal */ "./src/common/components/RequestDataExportModal.tsx");
/* harmony import */ var _components_DeleteUserModal__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ../components/DeleteUserModal */ "./src/forum/components/DeleteUserModal.tsx");






function extendUserControls() {
  (0,flarum_common_extend__WEBPACK_IMPORTED_MODULE_1__.extend)((flarum_forum_utils_UserControls__WEBPACK_IMPORTED_MODULE_2___default()), 'moderationControls', function (items, user) {
    if (user.canModerateExports()) {
      items.add('gdpr-export', m((flarum_common_components_Button__WEBPACK_IMPORTED_MODULE_3___default()), {
        icon: "fas fa-file-export",
        onclick: function onclick() {
          return flarum_forum_app__WEBPACK_IMPORTED_MODULE_0___default().modal.show(_common_components_RequestDataExportModal__WEBPACK_IMPORTED_MODULE_4__["default"], {
            user: user
          });
        }
      }, flarum_forum_app__WEBPACK_IMPORTED_MODULE_0___default().translator.trans('blomstra-gdpr.forum.settings.export_data_button')));
    }
  });
  (0,flarum_common_extend__WEBPACK_IMPORTED_MODULE_1__.extend)((flarum_forum_utils_UserControls__WEBPACK_IMPORTED_MODULE_2___default()), 'destructiveControls', function (items, user) {
    items.remove('delete');
    if (user.canDelete()) {
      items.add('gdpr-erase', m((flarum_common_components_Button__WEBPACK_IMPORTED_MODULE_3___default()), {
        icon: "fas fa-eraser",
        onclick: function onclick() {
          return flarum_forum_app__WEBPACK_IMPORTED_MODULE_0___default().modal.show(_components_DeleteUserModal__WEBPACK_IMPORTED_MODULE_5__["default"], {
            user: user
          });
        }
      }, flarum_forum_app__WEBPACK_IMPORTED_MODULE_0___default().translator.trans('blomstra-gdpr.forum.delete_user.delete_button')));
    }
  });
}

/***/ }),

/***/ "./src/forum/extenders/extendUserSettingsPage.tsx":
/*!********************************************************!*\
  !*** ./src/forum/extenders/extendUserSettingsPage.tsx ***!
  \********************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ extendUserSettingsPage)
/* harmony export */ });
/* harmony import */ var flarum_forum_app__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! flarum/forum/app */ "flarum/forum/app");
/* harmony import */ var flarum_forum_app__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(flarum_forum_app__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var flarum_common_extend__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! flarum/common/extend */ "flarum/common/extend");
/* harmony import */ var flarum_common_extend__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(flarum_common_extend__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var flarum_common_utils_ItemList__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! flarum/common/utils/ItemList */ "flarum/common/utils/ItemList");
/* harmony import */ var flarum_common_utils_ItemList__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(flarum_common_utils_ItemList__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var flarum_forum_components_SettingsPage__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! flarum/forum/components/SettingsPage */ "flarum/forum/components/SettingsPage");
/* harmony import */ var flarum_forum_components_SettingsPage__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(flarum_forum_components_SettingsPage__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var flarum_common_components_FieldSet__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! flarum/common/components/FieldSet */ "flarum/common/components/FieldSet");
/* harmony import */ var flarum_common_components_FieldSet__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(flarum_common_components_FieldSet__WEBPACK_IMPORTED_MODULE_4__);
/* harmony import */ var flarum_common_components_Button__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! flarum/common/components/Button */ "flarum/common/components/Button");
/* harmony import */ var flarum_common_components_Button__WEBPACK_IMPORTED_MODULE_5___default = /*#__PURE__*/__webpack_require__.n(flarum_common_components_Button__WEBPACK_IMPORTED_MODULE_5__);
/* harmony import */ var _components_RequestErasureModal__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ../components/RequestErasureModal */ "./src/forum/components/RequestErasureModal.js");
/* harmony import */ var _common_components_RequestDataExportModal__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! ../../common/components/RequestDataExportModal */ "./src/common/components/RequestDataExportModal.tsx");








function extendUserSettingsPage() {
  (0,flarum_common_extend__WEBPACK_IMPORTED_MODULE_1__.extend)((flarum_forum_components_SettingsPage__WEBPACK_IMPORTED_MODULE_3___default().prototype), 'settingsItems', function (items) {
    var user = this.user;
    if (!user) {
      return;
    }
    items.add('dataItems', m((flarum_common_components_FieldSet__WEBPACK_IMPORTED_MODULE_4___default()), {
      className: "Settings-gdpr",
      label: flarum_forum_app__WEBPACK_IMPORTED_MODULE_0___default().translator.trans('blomstra-gdpr.forum.settings.data.heading')
    }, this.dataItems().toArray()), -100);
  });
  (flarum_forum_components_SettingsPage__WEBPACK_IMPORTED_MODULE_3___default().prototype).dataItems = function () {
    var _this = this;
    var items = new (flarum_common_utils_ItemList__WEBPACK_IMPORTED_MODULE_2___default())();
    items.add('gdprErasure', m("div", {
      className: "gdprErasure-container"
    }, m((flarum_common_components_Button__WEBPACK_IMPORTED_MODULE_5___default()), {
      className: "Button Button-gdprErasure",
      icon: "fas fa-user-minus",
      onclick: function onclick() {
        return flarum_forum_app__WEBPACK_IMPORTED_MODULE_0___default().modal.show(_components_RequestErasureModal__WEBPACK_IMPORTED_MODULE_6__["default"]);
      }
    }, flarum_forum_app__WEBPACK_IMPORTED_MODULE_0___default().translator.trans('blomstra-gdpr.forum.settings.request_erasure_button')), m("p", {
      className: "helpText"
    }, flarum_forum_app__WEBPACK_IMPORTED_MODULE_0___default().translator.trans('blomstra-gdpr.forum.settings.request_erasure_help'))), 50);
    items.add('gdprExport', m("div", {
      className: "gdprExport-container"
    }, m((flarum_common_components_Button__WEBPACK_IMPORTED_MODULE_5___default()), {
      className: "Button Button-gdprExport",
      icon: "fas fa-file-export",
      onclick: function onclick() {
        return flarum_forum_app__WEBPACK_IMPORTED_MODULE_0___default().modal.show(_common_components_RequestDataExportModal__WEBPACK_IMPORTED_MODULE_7__["default"], {
          user: _this.user
        });
      }
    }, flarum_forum_app__WEBPACK_IMPORTED_MODULE_0___default().translator.trans('blomstra-gdpr.forum.settings.export_data_button')), m("p", {
      className: "helpText"
    }, flarum_forum_app__WEBPACK_IMPORTED_MODULE_0___default().translator.trans('blomstra-gdpr.forum.settings.export_data_help'))), 40);
    return items;
  };
}

/***/ }),

/***/ "./src/forum/index.ts":
/*!****************************!*\
  !*** ./src/forum/index.ts ***!
  \****************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   extend: () => (/* reexport safe */ _extend__WEBPACK_IMPORTED_MODULE_8__["default"])
/* harmony export */ });
/* harmony import */ var flarum_forum_app__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! flarum/forum/app */ "flarum/forum/app");
/* harmony import */ var flarum_forum_app__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(flarum_forum_app__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _states_ErasureRequestsListState__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./states/ErasureRequestsListState */ "./src/forum/states/ErasureRequestsListState.ts");
/* harmony import */ var _components_ExportAvailableNotification__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./components/ExportAvailableNotification */ "./src/forum/components/ExportAvailableNotification.ts");
/* harmony import */ var _extenders_extendUserSettingsPage__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./extenders/extendUserSettingsPage */ "./src/forum/extenders/extendUserSettingsPage.tsx");
/* harmony import */ var _extenders_extendHeaderSecondary__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./extenders/extendHeaderSecondary */ "./src/forum/extenders/extendHeaderSecondary.tsx");
/* harmony import */ var _extenders_extendPage__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./extenders/extendPage */ "./src/forum/extenders/extendPage.ts");
/* harmony import */ var _extenders_extendUserControls__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ./extenders/extendUserControls */ "./src/forum/extenders/extendUserControls.tsx");
/* harmony import */ var _addAnonymousBadges__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! ./addAnonymousBadges */ "./src/forum/addAnonymousBadges.tsx");
/* harmony import */ var _extend__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! ./extend */ "./src/forum/extend.ts");









flarum_forum_app__WEBPACK_IMPORTED_MODULE_0___default().initializers.add('blomstra-gdpr', function () {
  (flarum_forum_app__WEBPACK_IMPORTED_MODULE_0___default().erasureRequests) = new _states_ErasureRequestsListState__WEBPACK_IMPORTED_MODULE_1__["default"]();
  (flarum_forum_app__WEBPACK_IMPORTED_MODULE_0___default().notificationComponents).gdprExportAvailable = _components_ExportAvailableNotification__WEBPACK_IMPORTED_MODULE_2__["default"];
  (0,_extenders_extendUserSettingsPage__WEBPACK_IMPORTED_MODULE_3__["default"])();
  (0,_extenders_extendHeaderSecondary__WEBPACK_IMPORTED_MODULE_4__["default"])();
  (0,_extenders_extendPage__WEBPACK_IMPORTED_MODULE_5__["default"])();
  (0,_extenders_extendUserControls__WEBPACK_IMPORTED_MODULE_6__["default"])();
  (0,_addAnonymousBadges__WEBPACK_IMPORTED_MODULE_7__["default"])();
});

/***/ }),

/***/ "./src/forum/states/ErasureRequestsListState.ts":
/*!******************************************************!*\
  !*** ./src/forum/states/ErasureRequestsListState.ts ***!
  \******************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ ErasureRequestsListState)
/* harmony export */ });
/* harmony import */ var flarum_forum_app__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! flarum/forum/app */ "flarum/forum/app");
/* harmony import */ var flarum_forum_app__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(flarum_forum_app__WEBPACK_IMPORTED_MODULE_0__);

var ErasureRequestsListState = /*#__PURE__*/function () {
  function ErasureRequestsListState() {
    this.loading = false;
    this.requestsLoaded = false;
  }
  var _proto = ErasureRequestsListState.prototype;
  _proto.load = function load() {
    var _this = this;
    if (this.requestsLoaded) {
      return;
    }
    this.loading = true;
    m.redraw();
    flarum_forum_app__WEBPACK_IMPORTED_MODULE_0___default().store.find('user-erasure-requests').then(function () {
      return _this.requestsLoaded = true;
    }, function () {}).then(function () {
      _this.loading = false;
      m.redraw();
    });
  };
  return ErasureRequestsListState;
}();


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

/***/ "flarum/common/components/Badge":
/*!****************************************************************!*\
  !*** external "flarum.core.compat['common/components/Badge']" ***!
  \****************************************************************/
/***/ ((module) => {

"use strict";
module.exports = flarum.core.compat['common/components/Badge'];

/***/ }),

/***/ "flarum/common/components/Button":
/*!*****************************************************************!*\
  !*** external "flarum.core.compat['common/components/Button']" ***!
  \*****************************************************************/
/***/ ((module) => {

"use strict";
module.exports = flarum.core.compat['common/components/Button'];

/***/ }),

/***/ "flarum/common/components/FieldSet":
/*!*******************************************************************!*\
  !*** external "flarum.core.compat['common/components/FieldSet']" ***!
  \*******************************************************************/
/***/ ((module) => {

"use strict";
module.exports = flarum.core.compat['common/components/FieldSet'];

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

/***/ "flarum/common/components/Page":
/*!***************************************************************!*\
  !*** external "flarum.core.compat['common/components/Page']" ***!
  \***************************************************************/
/***/ ((module) => {

"use strict";
module.exports = flarum.core.compat['common/components/Page'];

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

/***/ "flarum/common/helpers/humanTime":
/*!*****************************************************************!*\
  !*** external "flarum.core.compat['common/helpers/humanTime']" ***!
  \*****************************************************************/
/***/ ((module) => {

"use strict";
module.exports = flarum.core.compat['common/helpers/humanTime'];

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

/***/ "flarum/common/utils/Stream":
/*!************************************************************!*\
  !*** external "flarum.core.compat['common/utils/Stream']" ***!
  \************************************************************/
/***/ ((module) => {

"use strict";
module.exports = flarum.core.compat['common/utils/Stream'];

/***/ }),

/***/ "flarum/common/utils/extractText":
/*!*****************************************************************!*\
  !*** external "flarum.core.compat['common/utils/extractText']" ***!
  \*****************************************************************/
/***/ ((module) => {

"use strict";
module.exports = flarum.core.compat['common/utils/extractText'];

/***/ }),

/***/ "flarum/forum/app":
/*!**************************************************!*\
  !*** external "flarum.core.compat['forum/app']" ***!
  \**************************************************/
/***/ ((module) => {

"use strict";
module.exports = flarum.core.compat['forum/app'];

/***/ }),

/***/ "flarum/forum/components/HeaderSecondary":
/*!*************************************************************************!*\
  !*** external "flarum.core.compat['forum/components/HeaderSecondary']" ***!
  \*************************************************************************/
/***/ ((module) => {

"use strict";
module.exports = flarum.core.compat['forum/components/HeaderSecondary'];

/***/ }),

/***/ "flarum/forum/components/Notification":
/*!**********************************************************************!*\
  !*** external "flarum.core.compat['forum/components/Notification']" ***!
  \**********************************************************************/
/***/ ((module) => {

"use strict";
module.exports = flarum.core.compat['forum/components/Notification'];

/***/ }),

/***/ "flarum/forum/components/NotificationsDropdown":
/*!*******************************************************************************!*\
  !*** external "flarum.core.compat['forum/components/NotificationsDropdown']" ***!
  \*******************************************************************************/
/***/ ((module) => {

"use strict";
module.exports = flarum.core.compat['forum/components/NotificationsDropdown'];

/***/ }),

/***/ "flarum/forum/components/SettingsPage":
/*!**********************************************************************!*\
  !*** external "flarum.core.compat['forum/components/SettingsPage']" ***!
  \**********************************************************************/
/***/ ((module) => {

"use strict";
module.exports = flarum.core.compat['forum/components/SettingsPage'];

/***/ }),

/***/ "flarum/forum/components/UserCard":
/*!******************************************************************!*\
  !*** external "flarum.core.compat['forum/components/UserCard']" ***!
  \******************************************************************/
/***/ ((module) => {

"use strict";
module.exports = flarum.core.compat['forum/components/UserCard'];

/***/ }),

/***/ "flarum/forum/utils/UserControls":
/*!*****************************************************************!*\
  !*** external "flarum.core.compat['forum/utils/UserControls']" ***!
  \*****************************************************************/
/***/ ((module) => {

"use strict";
module.exports = flarum.core.compat['forum/utils/UserControls'];

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
  !*** ./forum.ts ***!
  \******************/
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   extend: () => (/* reexport safe */ _src_forum__WEBPACK_IMPORTED_MODULE_0__.extend)
/* harmony export */ });
/* harmony import */ var _src_forum__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./src/forum */ "./src/forum/index.ts");

})();

module.exports = __webpack_exports__;
/******/ })()
;
//# sourceMappingURL=forum.js.map