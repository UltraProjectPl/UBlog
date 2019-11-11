import { Action } from 'redux';

export interface ActionWithPayload<T extends string, P> extends Action<T> {
    payload: P
}

export function createAction<T extends string>(type: T): ActionWithPayload<T, {}>;
export function createAction<T extends string, P>(type: T, payload: P): ActionWithPayload<T, P>;
export function createAction<T extends string, P>(type: T, payload?: P) {
    return typeof payload === 'undefined' ? { type } : { type, payload };
}

export interface Dictionary<T> {
    [index: string]: T
}

type FunctionType = (...args: any[]) => any;
type ActionCreatorsMapObject = Dictionary<FunctionType>;

export type ActionsUnion<A extends ActionCreatorsMapObject> = ReturnType<A[keyof A]>
