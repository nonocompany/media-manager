import Dropzone from "react-dropzone";
import axios from "axios";


export const FileUploader = (props: {folderId: string|undefined}) => {

    const mediaUpload =  (acceptedFiles: any) => {
        console.log(acceptedFiles, "<=========");

        const uploadPromises = acceptedFiles.map( (file: any) =>  {
            const forms = new FormData();
            forms.append('file', file);
            const folderId = props.folderId ? "/"+props.folderId : "";
            return axios.post(`/medias/api/files/upload${folderId}`, forms, {
                headers: {
                    'Content-Type': 'multipart/form-data',
                }
            })
        });

        Promise.all(uploadPromises).then((responses) => {
            const allUploadedFiles = responses.map(response => response.data.media);
            console.log(allUploadedFiles, "<=========   All uploaded Medias");
        })
    }

    return (
        <div className={"card"}>
            <div className="card-body">
                <Dropzone
                          onDrop={acceptedFiles => mediaUpload(acceptedFiles)}>
                    {({getRootProps, getInputProps}) => (
                        <div className="dropzone-container">
                            <div className="dropzone" {...getRootProps()}>
                                <input {...getInputProps()} />
                                <strong>Resimleri sürükle veya tıkla</strong>
                            </div>
                        </div>
                    )}
                </Dropzone>
            </div>
        </div>
    )
}
