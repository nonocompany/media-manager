import {createContext, useContext, useState} from 'react';
import {File, FileContext} from '../types';


const FileSelectedContext = createContext<FileContext>({
    data: [],
    sync: (): void => {
    }
});

export const useSelectedContext = () => {
    return useContext(FileSelectedContext);
};

export const FileSelectedContextProvider = ({children}: { children: JSX.Element }): JSX.Element => {
    const [data, setData] = useState<File[]>([]);

    // Veriyi güncelleyen fonksiyon
    const sync = (data: File[]): void => {
        setData(data);
    };

    return (
        <FileSelectedContext.Provider value={{data, sync}}>
            {children}
        </FileSelectedContext.Provider>
    );
};
