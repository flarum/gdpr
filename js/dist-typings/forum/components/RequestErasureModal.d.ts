/// <reference types="flarum/@types/translator-icu-rich" />
export default class RequestErasureModal extends Modal<import("flarum/common/components/Modal").IInternalModalAttrs, undefined> {
    constructor();
    oninit(vnode: any): void;
    reason: any;
    password: any;
    title(): import("@askvortsov/rich-icu-message-formatter").NestedStringArray;
    content(): JSX.Element;
    fields(): ItemList<any>;
    oncancel(e: any): void;
    data(): {
        reason: any;
        status: string;
        relationships: {
            user: import("flarum/common/models/User").default | null;
        };
    };
    onsubmit(e: any): void;
}
import Modal from "flarum/common/components/Modal";
import ItemList from "flarum/common/utils/ItemList";
