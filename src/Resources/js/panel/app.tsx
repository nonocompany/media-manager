import React, {useState} from "react";
import ReactDOM from "react-dom/client";
import {HashRouter, MemoryRouter} from "react-router-dom";
import {Index} from "./layouts/index";
import "../../css/panel/app.css";
import {library} from '@fortawesome/fontawesome-svg-core'
import {fas} from '@fortawesome/free-solid-svg-icons'
import {StateContextProvider, useStateContext} from "./contexts/StateContext";

library.add(fas)

const mediasInputElements = document.getElementsByClassName("medias-input");
const popupBackgroundElement = document.querySelector(".popupBackground");

for (const element of mediasInputElements) {
    const hiddenInput = document.createElement("input");
    let acceptedFile = "";
    let name = "";
    let isMultiple = false;
    hiddenInput.type = "hidden";
    for (const attribute of element.attributes) {
        if (attribute.name === "name") {
            hiddenInput.name = `medias[${attribute.value}]`;
            hiddenInput.id = attribute.value;
            name = attribute.value;
        }
        if (attribute.name === "accepted-file") {
            acceptedFile = attribute.value;
        }
        if (attribute.name === "multiple") {
            console.log(attribute.name);
            isMultiple = true;
        }
    }

    document.querySelector("form").append(hiddenInput);
    ReactDOM.createRoot(element!).render(
        <React.StrictMode>
            <HashRouter>
                <StateContextProvider>
                    <Index name={name} isMultiple={isMultiple} acceptedFile={acceptedFile}/>
                </StateContextProvider>
            </HashRouter>
        </React.StrictMode>
    );
}


