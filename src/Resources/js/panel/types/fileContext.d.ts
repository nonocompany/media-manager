import { File } from './file'
export interface FileContext {
    data: File[]|[],
    sync: (data: File[]|[]) => void
}
