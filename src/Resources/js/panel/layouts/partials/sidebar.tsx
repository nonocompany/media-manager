import {useSelectedContext} from '../../contexts/FileSelectedContext';
import {useStateContext} from '../../contexts/StateContext';
import {Logo} from '../../components';
import {File} from '../../types';
import classNames from "classnames";
import {useEffect} from "react";
export const Sidebar = () => {
    const {data, setData} = useSelectedContext();

    return (
        <div className={classNames('sidebarContainer')}>
            <aside>
                <div className="sidebarLogo">
                    <Logo/>
                </div>
                {
                    <div className="row">
                        <div className="col-12">
                            <div className="sidebarTitle">
                                Media Manager
                            </div>
                        </div>

                        <div className="col-12">
                            <p><strong>Seçilen Dosyalar</strong></p>
                            <div className="selectedItems">
                                {
                                    data?.map((file: File) => {
                                        return <SmallFileCard key={file.id} {...file} />
                                    })
                                }
                            </div>
                        </div>

                        <div className="sidebarFooter">
                            <p><strong>Seçilen Dosyaları</strong></p>
                            <div className="btn-group w-100">
                                <button type={"button"} className="btn btn-primary">Seç</button>
                                <button type={"button"} className="btn btn-outline-danger b-0">Sil</button>
                            </div>
                        </div>

                    </div>
                }


            </aside>
        </div>
    )
}

export const SmallFileCard = (file: File) => {
    const {data, setData} = useSelectedContext();
    const removeFile = (file: File) => {
        setData(data.filter((item: File) => item.id !== file.id));
    }
    return (
        <div className="imageCover shadow" onClick={() => removeFile(file)}>
            <img src={file.url} className="image" alt=""/>
            <div className="imageCoverRemove">
                <i className="bi bi-x-lg"></i>
            </div>
        </div>
    )
}
