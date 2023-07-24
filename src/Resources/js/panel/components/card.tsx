import {File, Folder} from '../types'
import classNames from "classnames";
import {useSelectedContext} from '../contexts/FileSelectedContext';
import {NavLink} from "react-router-dom";


export const Explorer = (folder: Folder) => {

    return (
        <div className="listBox">
            <NavLink to={'/folders/create'} className="card">
                <div className="card-header">
                    <h5 className="card-title">Yeni Klasör</h5>
                </div>
                <div className="card-body">
                    <i className="bi bi-folder-plus"></i>
                </div>
            </NavLink>
            {
                folder?.children?.map((childFolder: Folder) => {
                    return <FolderCard key={childFolder.id} {...childFolder} />
                })
            }
            {
                folder?.files?.map((file: File) => {
                    return <FileCard key={file.id} {...file} />
                })
            }
        </div>
    )
}
export const FolderCard = (folder: Folder) => {
    return (
        <div className="card">
            <div className="card-header">
                <h5 className="card-title">{folder.name}</h5>
            </div>
            <div className="card-body">
                <i className="bi bi-folder"></i>
            </div>
        </div>
    )
}

export const FileCard = (file: File) => {
    const {data, sync} = useSelectedContext();
    const toggleSelected = (file: File) => {
        let index = data.findIndex((item: File) => item.id === file.id);
        if (index === -1) {
            sync([...data, file]);
        } else {
            sync(data.filter((item: File) => item.id !== file.id));
        }
    }

    const isSelected = data.find((item) => item.id === file.id) !== undefined;
    return (
        <div className={classNames("card", {"selected": isSelected})} onClick={() => toggleSelected(file)}>
            <img src={file.url} className="card-img" alt="..."/>
            <i className="bi bi-check-circle-fill"></i>
        </div>
    )
}



