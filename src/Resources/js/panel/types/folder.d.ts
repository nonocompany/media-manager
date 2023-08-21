import {File} from "./";
export interface Folder {
    id: string|null,
    name: string,
    parent_id: string|null,
    children: Folder[]|[],
    files: File[]|[],
}
