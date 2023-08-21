import { File } from './file'
export interface FileContext {
    data: File[]|[],
    setData: (data: File[]|[]) => void
}
