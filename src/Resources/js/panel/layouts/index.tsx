
import { Router } from "../routes/index";
import {useEffect, useState} from "react";
import classnames from 'classnames';
import {useStateContext} from "../contexts/StateContext";

export const Index = (props: {name: string, acceptedFile: string, isMultiple: boolean}) => {
    const [popupStatus, setPopupStatus] = useState(false)
    const {state, setState} = useStateContext();

    useEffect(() => {
        setState({
            name: props.name,
            acceptedFile: props.acceptedFile,
            isMultiple: props.isMultiple,
        });
    }, [])
    const togglePopup = (event: any) => {
        console.log(event.target.className)
        if (event.target.className === "medias-input") {
            setPopupStatus(!popupStatus)
        }

        if (event.target.className === "popupBackground") {
            setPopupStatus(false)
        }
    }

   return(
       <div className={"medias-input"} onClick={togglePopup}>
           <div className={classnames({"d-none": !popupStatus})} >
               <div className="popupBackground"></div>
               <div className="popupContainer">
                   <div className="container">
                       <div className="row">
                           <div className="col-12">
                               <Router></Router>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
       </div>
    )
}
