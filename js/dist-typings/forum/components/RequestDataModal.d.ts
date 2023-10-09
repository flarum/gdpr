/// <reference types="flarum/@types/translator-icu-rich" />
export default class RequestDataModal {
    className(): string;
    title(): import("@askvortsov/rich-icu-message-formatter").NestedStringArray;
    content(): JSX.Element;
    onsubmit(e: any): void;
    loading: boolean | undefined;
}
