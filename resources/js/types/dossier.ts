import type { Infraction } from './infraction'

export type DossierPriority = 'faible' | 'normale' | 'haute'

export interface Dossier {
    id: number
    numero_dossier: string
    objet: string
    type_dossier: string
    priorite: DossierPriority
    source_signalement: string
    plaignant?: string | null
    accuse?: string | null
    coordonnees_gps?: string | null
    adresse_complete?: string | null
    description_initiale?: string | null
    date_arrive: string
    statut: string
    created_at: string
    updated_at: string
    user_id: number
    annexe_id?: number | null
    district_id?: number | null
    annexe?: {
        id: number
        nom: string
        district_id?: number
    }
    district?: {
        id: number
        nom: string
    }
    user?: {
        id: number
        name: string
    }
    requerants?: Requerant[]
    auteurs?: Auteur[]
}

export interface Requerant {
    id: number
    nom: string
    cin?: string | null
    contact?: string | null
    adresse?: string | null
    type_requerant?: string | null
    ice?: string | null
    pivot?: {
        role?: string
        commentaire?: string
    }
}

export interface Auteur {
    id: number
    nom: string
    prenom?: string | null
    cin?: string | null
    statut_professionnel?: string | null
    telephone?: string | null
    adresse?: string | null
    ville?: string | null
    raison_sociale?: string | null
    ice?: string | null
    pivot?: {
        role_auteur?: string
        commentaire?: string
    }
}

export interface DossierFormData {
    numero_dossier: string
    objet: string
    type_dossier: string
    priorite: DossierPriority
    source_signalement: string
    plaignant: string | null
    accuse: string | null
    coordonnees_gps: string | null
    adresse_complete: string | null
    description_initiale: string | null
    date_arrive: string
    user_id: number | null
    annexe_id: number | null
    district_id: number | null
    statut: string
}