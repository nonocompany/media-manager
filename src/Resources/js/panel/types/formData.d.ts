export interface FormData{
    name: string;
    value: string | ReadonlyArray<string> | number | undefined;
    vModel: (formData: FormData) => FormData,
    label: string;
}
