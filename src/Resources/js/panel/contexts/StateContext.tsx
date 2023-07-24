import {createContext, useContext, useState} from 'react';
import {StateContext} from '../types';


const StatateContext = createContext<StateContext>({
    state: {
        sidebarStatus: true
    },
    updateState: (): void => {
    }
});

export const useStateContext = () => {

    return useContext(StatateContext);;
};

export const StatateContextProvider = ({children}: { children: JSX.Element }): JSX.Element => {
    const [state, setData] = useState<StateContext>([]);


    // Veriyi güncelleyen fonksiyon
    const updateState = (state: StateContext): void => {
        setData(state);
    };



    return (
        <StatateContext.Provider value={{state, updateState}}>
            {children}
        </StatateContext.Provider>
    );
};
