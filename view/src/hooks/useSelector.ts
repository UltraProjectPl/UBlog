import { useSelector as baseUseSelector } from 'react-redux';
import { ApplicationState } from '../store';

type UseSelector = <T>(
    selector: (state: ApplicationState) => T,
    qualityFn?: (a: T, b: T) => boolean
) => T

export const useSelector: UseSelector = baseUseSelector;
