export default class RequestErasureModal {
    oninit(vnode: any): void;
    reason: any;
    password: any;
    className(): string;
    title(): any;
    content(): JSX.Element;
    fields(): any;
    oncancel(e: any): void;
    loading: boolean | undefined;
    data(): {
        reason: any;
        status: string;
        relationships: {
            user: any;
        };
    };
    onsubmit(e: any): void;
}
