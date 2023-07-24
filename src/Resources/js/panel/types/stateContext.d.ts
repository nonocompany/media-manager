export interface StateContext {
    state: {
        sidebarStatus: boolean,
    },
    updateState: (state: StateContext.state) => void,
}
