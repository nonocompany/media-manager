import {Sidebar} from "./partials/sidebar";
import {Header} from "./partials/header";
import { Router } from "../routes/index";

export const Index = () => {
    return (
        <div>
            <div className="popupBackground"></div>
            <div className="popupContainer">
                <div className="container">
                    <div className="row">
                        <div className="col-2">
                            <Sidebar></Sidebar>
                        </div>
                        <div className="col-10">
                            <div className="row">
                                <div className="col-12">
                                    <Header />
                                </div>
                            </div>
                            <div className="row">
                                <div className="col-12">
                                    <Router></Router>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    )
}
