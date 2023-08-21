import {createContext, useContext, useState} from 'react';
import {File, FileContext} from '../types';


const FileSelectedContext = createContext<FileContext>({
    data: [],
    setData: (): void => {
    }
});

export const useSelectedContext = () => {
    return useContext(FileSelectedContext);
};

export const FileSelectedContextProvider = ({children}: { children: JSX.Element }): JSX.Element => {
    const [data, setData] = useState<File[]>([]);


    return (
        <FileSelectedContext.Provider value={{data, setData}}>
            {children}
        </FileSelectedContext.Provider>
    );
};
