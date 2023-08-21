import {createContext, useContext, useState} from 'react';

const StateContext = createContext({
    state: {
        name: "",
        acceptedFile: "",
        isMultiple: false,
    },
    setState: (): void => {}
});

export const useStateContext = () => {
    return useContext(StateContext);
}

export const StateContextProvider = ({children}: { children: JSX.Element }): JSX.Element => {
    const [state, setState] = useState({
        name: "",
        acceptedFile: "",
        isMultiple: false,
    });

    return (
        <StateContext.Provider value={{state, setState}}>
            {children}
        </StateContext.Provider>
    );
}
