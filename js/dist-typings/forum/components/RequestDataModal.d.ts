/// <reference types="flarum/@types/translator-icu-rich" />
export default class RequestDataModal extends Modal<import("flarum/common/components/Modal").IInternalModalAttrs, undefined> {
    constructor();
    title(): import("@askvortsov/rich-icu-message-formatter").NestedStringArray;
    content(): JSX.Element;
    onsubmit(e: any): void;
}
import Modal from "flarum/common/components/Modal";
