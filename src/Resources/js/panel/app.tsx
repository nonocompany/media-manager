import React from "react";
import ReactDOM from "react-dom/client";
import {MemoryRouter} from "react-router-dom";
import {Index} from "./layouts/index";
import {FileSelectedContextProvider} from "./contexts/FileSelectedContext";
import {StatateContextProvider} from "./contexts/StateContext";

const aa: string | null = document.getElementById("root").getAttribute("data-react-props");
let inputElement = document.createElement("input");

// Özelliklerini ayarlayın
inputElement.setAttribute("type", "hidden");
inputElement.setAttribute("name", "react-props");

// Elementi sayfaya ekleyin (örneğin, bir formun içine eklemek için)
let formElement = document.querySelector("form"); // formun id'si myForm olarak varsayalım
formElement.appendChild(inputElement);
console.log(aa);
ReactDOM.createRoot(document.getElementById("root")!).render(
    <React.StrictMode>
        <MemoryRouter>
            <StatateContextProvider>
            <FileSelectedContextProvider>
                <Index/>
            </FileSelectedContextProvider>
            </StatateContextProvider>
        </MemoryRouter>
    </React.StrictMode>
);
