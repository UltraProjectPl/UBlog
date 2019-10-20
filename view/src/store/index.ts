import { combineReducers } from 'redux';

export const createRootReducer = () => combineReducers({});

export type ApplicationState = ReturnType<ReturnType<typeof createRootReducer>>;
