import { useDispatch as baseUseDispatch } from 'react-redux';
import { ThunkDispatch } from '../store';

type UseDispatch = () => ThunkDispatch;

export const useDispatch: UseDispatch = baseUseDispatch;
