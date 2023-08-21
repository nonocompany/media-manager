import {File, Folder} from '../types'
import classNames from "classnames";
import {NavLink, useLocation, useParams} from "react-router-dom";
import {useEffect, useState} from "react";
import axios from "axios";
import {FontAwesomeIcon} from "@fortawesome/react-fontawesome";
import {Logo} from "./logo";
import {FileUploader} from "./fileUploader";
import {useStateContext} from "../contexts/StateContext";


export const Explorer = () => {
    const {state, setState} = useStateContext();
    const [selected, setSelected] = useState<number[]>([])
    const [newFolder, setNewFolder] = useState(null)
    const [newFolderRowStatus, setNewFolderRowStatus] = useState<boolean>(false)
    const [fileUploadStatus, setFileUploadStatus] = useState<boolean>(false)
    const {id} = useParams();
    const [folders, setFolders] = useState<Folder[]>([]);
    const location = useLocation();
    const [currentFolder, setCurrentFolder] = useState<Folder>({} as Folder)
    const [files, setFiles] = useState<File[]>([])
    const openingFileTypes = ['jpg', 'jpeg', 'png', 'gif', 'svg', 'pdf']
    const getFolders = () => {
        if (id === undefined) {
            axios.get(`/medias/api/folders`).then((response) => {
                setFolders(response.data.data);
            })
            axios.get('/medias/api/files').then((response) => {
                setFiles(response.data.data);
            })
        } else {
            axios.get(`/medias/api/folders/${id}`).then((response) => {
                setFolders(response.data.data.folders);
                setCurrentFolder(response.data.data)
                setFiles(response.data.data.files)
                console.log(response.data, "<?====")
            })
        }

    }

    useEffect(() => {
        getFolders();
    }, []);
    useEffect(() => {
        getFolders();
    }, [location]);

    const handleNewFolder = (e: React.ChangeEvent<HTMLInputElement>) => {
        setNewFolder({
            'name': e.target.value,
            'parent_id': id !== undefined ? id : null
        })
    }

    const submitNewFolder = () => {
        if (newFolder === undefined && newFolder?.name?.length > 3) return
        axios.post('/medias/api/folders', newFolder).then((response) => {
            getFolders();
            setNewFolderRowStatus(false)
        });
    }

    const handleSelected = (event: any) => {
        const {checked, value} = event.target;
        console.log(state);
        if (checked) {
            setSelected([...selected, value])
        } else {
            setSelected(selected.filter((item) => item !== value))
        }
    }

    const isMultiple = (id: string) => {

        if (state.isMultiple) {
            return false
        } else if (state.isMultiple === false && selected.length > 0) {
            return true
        } else {
            return false
        }
        if (selected.filter((item) => item === id).length > 0) {
            return false
        }
    }

    useEffect(() => {
        console.log(document.getElementById(state.name))
        if (selected.length > 0) {
            if (state.isMultiple) {
                document.getElementById(state.name).value = selected
            } else {
                document.getElementById(state.name).value = selected[0]
            }
        }
    }, [selected]);

    return (
        <div>

            <div className="card mb-4">
                <div className="card-body">
                    <div className="d-flex">
                        <div className="flex-grow-1 d-flex">
                            <Logo/>
                        </div>
                        <div className="flex-grow-0">
                            <button className="btn btn-outline-primary me-3"
                                    type={"button"}
                                    onClick={() => setFileUploadStatus(!fileUploadStatus)}
                            >
                                <i className="bi bi-cloud-arrow-up-fill"></i> Dosya Yükle
                            </button>
                            <button className="btn btn-primary"
                                    type={"button"}
                                    onClick={() => setNewFolderRowStatus(!newFolderRowStatus)}
                            >
                                <i className="bi bi-folder-plus"></i> Yeni Klasör
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <ol className="breadcrumb">
                <li className="breadcrumb-item"><NavLink to={"/"}>Ana Dizin</NavLink></li>
                {
                    id && currentFolder.breandcrumbs !== undefined && currentFolder.breandcrumbs.map((breadcrumb) => {
                        return (
                            <li className="breadcrumb-item" key={breadcrumb.id}>
                                <NavLink to={`/folders/${breadcrumb.id}`}>{breadcrumb.name}</NavLink>
                            </li>
                        )
                    })
                }
                {
                    id && <li className="breadcrumb-item active" aria-current="page">{currentFolder.name}</li>
                }
            </ol>

            {
                fileUploadStatus && <FileUploader folderId={id}/>
            }
            {
                !fileUploadStatus && (
                    <div className="card">
                        <div className="card-body">

                            <div className="table-responsive table-container">
                                <table className="table itemListTable">
                                    <thead>
                                    <tr>
                                        <th scope="col"></th>
                                        <th scope="col">İsim</th>
                                        <th scope="col">Boyut</th>
                                        <th scope="col">Son Değişiklik</th>
                                        <th scope="col"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    {newFolderRowStatus &&
                                        <tr>
                                            <td colSpan={5}>
                                                <div className="input-group">
                                                    <input type="text" className="form-control"
                                                           placeholder="Yeni Klasör Adı"
                                                           aria-label="Yeni Klasör Adı" onChange={handleNewFolder}/>
                                                    <button className="btn btn-outline-secondary"
                                                            type="button"
                                                            onClick={submitNewFolder}
                                                            id="button-addon2">Oluştur
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    }
                                    {
                                        folders.length > 0 && folders.map((folder) => {
                                            return (
                                                <tr key={folder.id}>
                                                    <td>
                                                        <div className="form-check">
                                                            <input className="form-check-input" type="checkbox" value=""
                                                                   id="flexCheckDefault"/>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <NavLink to={`/folders/${folder.id}`}
                                                                 className="d-flex align-items-center">
                                                            <FontAwesomeIcon icon="fa-solid fa-folder" size="2xl"
                                                                             className={"me-2"} style={{color: "#0b3d93"}}/>
                                                            <span>{folder.name}</span></NavLink>
                                                    </td>
                                                    <td>{folder.size}</td>
                                                    <td></td>
                                                    <td>
                                                        <FontAwesomeIcon icon="fa-solid fa-trash" size="xl"
                                                                         style={{color: "#dc3545"}}/>
                                                    </td>
                                                </tr>
                                            )
                                        })
                                    }
                                    {
                                        files.length > 0 && files.map((file) => {
                                            return (
                                                <tr key={file.id}>
                                                    <td>
                                                        <div className="form-check">
                                                            <input className="form-check-input" type="checkbox" value={file.id}
                                                                   onChange={handleSelected}
                                                                   disabled={isMultiple(file.id)}
                                                                   checked={selected.find((id) => id === file.id)}
                                                                   id="flexCheckDefault"/>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <FileTypes file={file}/>
                                                    </td>
                                                    <td>{file.size}</td>
                                                    <td></td>
                                                    <td>
                                                        <a href={file.url} download={""}>
                                                            <FontAwesomeIcon icon="fa-solid fa-download" size="xl"
                                                                             className={"me-2"} style={{color: "#146c43"}}/>
                                                        </a>
                                                        {
                                                            openingFileTypes.includes(file.extension) && (
                                                                <a href={file.url} target="_blank" rel="noreferrer"
                                                                >
                                                                    <FontAwesomeIcon icon="fa-solid fa-external-link" size="xl"
                                                                                     className={"me-2"} style={{color: "#0b3d93"}}/>
                                                                </a>
                                                            )
                                                        }

                                                        <FontAwesomeIcon icon="fa-solid fa-trash" size="xl"
                                                                         style={{color: "#dc3545"}}/>
                                                    </td>
                                                </tr>
                                            )
                                        })
                                    }
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                )
            }
        </div>
    )
}

export const FileTypes = (props: { file: File }) => {
    const imageTypes = ['jpg', 'jpeg', 'png', 'gif', 'svg']
    const pdfTypes = ['pdf']
    const excelTypes = ['xls', 'xlsx']
    const wordTypes = ['doc', 'docx']
    const powerpointTypes = ['ppt', 'pptx']

    const fileType = props.file.extension

    if (imageTypes.includes(fileType)) {
        return <FontAwesomeIcon icon="fa-solid fa-image" size="2xl" style={{color: "#ffc107"}}/>
    }

    if (pdfTypes.includes(fileType)) {
        return <FontAwesomeIcon icon="fa-solid fa-file-pdf" size="2xl" style={{color: "#dc3545"}}/>
    }

    if (excelTypes.includes(fileType)) {
        return <FontAwesomeIcon icon="fa-solid fa-file-excel" size="2xl" style={{color: "#198754"}}/>
    }

    if (wordTypes.includes(fileType)) {
        return <FontAwesomeIcon icon="fa-solid fa-file-word" size="2xl" style={{color: "#0b3d93"}}/>
    }

    if (powerpointTypes.includes(fileType)) {
        return <FontAwesomeIcon icon="fa-solid fa-file-powerpoint" size="2xl" style={{color: "#fd7e14"}}/>
    }

    return <FontAwesomeIcon icon="fa-solid fa-file" size="2xl" style={{color: "#0b3d93"}}/>


}




