import {useNavigate, useParams} from 'react-router-dom';
import {useStateContext} from '../../contexts/StateContext';
import {useEffect, useState} from "react";

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

    const [formData, setFormData] = useState({
        name: ''
    });

    const send = () => {

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
                        <input type="text" className="form-control" id="name" value={formData.name} onChange={
                            (event) => {
                                setFormData({...formData, name: event.target.value})
                            }
                        } placeholder="Klasör Adı"/>
                            <button className="btn btn-primary" type="button" onClick={send}>Kaydet</button>
                    </div>

                </div>
            </div>
        </div>
    )
}



