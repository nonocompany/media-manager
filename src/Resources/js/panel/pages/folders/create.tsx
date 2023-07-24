import {useNavigate, useParams} from 'react-router-dom';
import {useStateContext} from '../../contexts/StateContext';
import {useEffect} from "react";

export const Create = () => {
    const {parent_id} = useParams();
    const {updateState} = useStateContext();
    const navigate = useNavigate();

    useEffect(() => {
        updateState({sidebarStatus: true});
        return () => {
            updateState({sidebarStatus: false});
        }
    }, []);

    const backRoute = () => {
        navigate(-1)
    }

    return (
        <div>
            <div className="row">
                <div className="col-6">
                    <h1>Yeni Klasör Oluştur</h1>
                </div>
                <div className="col-6 text-end">
                    <button className="btn btn-primary btn-sm" type={'button'} onClick={backRoute}>
                        <i className="bi bi-backspace"></i> Geri Git
                    </button>
                </div>
            </div>

            <div className="row mt-4">
                <div className="col-12">
                    <div className="input-group">
                        <input type="text" className="form-control" id="name" placeholder="Klasör Adı"/>
                        <button className="btn btn-outline-success" type="button" id="send">Kaydet</button>
                    </div>

                </div>
            </div>
        </div>
    )
}
